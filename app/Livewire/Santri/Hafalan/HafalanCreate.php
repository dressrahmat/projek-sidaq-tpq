<?php

namespace App\Livewire\Santri\Hafalan;

use Carbon\Carbon;
use App\Traits\Quran;
use App\Models\Hafalan;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Livewire\Forms\HafalanForm;

class HafalanCreate extends Component
{
    use Quran;
    public HafalanForm $form;
    public $jumlahAyat;
    public $suratDetail;
    public $ayat;
    public $tanggal_dibuat;
    public $id;
    public $hafalanId;

    public function mount()
    {
        $this->id = auth()->user()->id;
        $this->tanggal_dibuat = Carbon::now()->format('Y-m-d');
        $this->hafalanId = null; // Reset hafalanId setiap kali form dibuka

        $this->changeDate();
    }

    public function changeDate()
    {
        $hafalan = Hafalan::whereHas('hafalan_user', function ($query) {
            $query->where('id_user', $this->id)->whereDate('hafalan_user.created_at', $this->tanggal_dibuat);
        })->first();
        
        if ($hafalan) {
            $this->form->setForm($hafalan);
            $this->hafalanId = $hafalan->id;
        } else {
            $this->form->reset();
            $this->hafalanId = null;
        }
    }

    public function changeSurat()
    {
        $this->suratDetail = $this->suratQuranDetail($this->form->surat);
        $this->jumlahAyat = $this->suratDetail["data"]["jumlahAyat"];

        // Update ayat options
        $this->ayat = range(1, $this->jumlahAyat);
    }

    public function save()
    {
        if ($this->form->surat) {
            $this->form->surat = $this->suratDetail["data"]["namaLatin"];
        }
        
        DB::beginTransaction();
        try {
            // Validasi tanggal
            $tanggalInput = Carbon::parse($this->tanggal_dibuat);
            $hariIni = Carbon::now();

            if ($tanggalInput->gt($hariIni)) {
                throw new \Exception('Anda menginputkan data untuk besok, silahkan pilih hari ini');
            }
            if ($this->hafalanId) {
                $this->form->update($this->id);
                $this->dispatch('sweet-alert', icon: 'success', title: 'Data berhasil diupdate');
            } else {
                // Create new kemampuan
                $this->form->store($this->id, $this->tanggal_dibuat);
                $this->dispatch('sweet-alert', icon: 'success', title: 'Data berhasil disimpan');
            }

            DB::commit();
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'Data gagal disimpan', text: $th->getMessage());
            DB::rollback();
        }

        $this->dispatch('refresh-data');
    }

    #[On('refresh-data')]
    public function render()
    {
        $suratData = $this->suratQuran();
        $suratData = $suratData['data'];
        return view('livewire.santri.hafalan.hafalan-create', compact('suratData'));
    }
}