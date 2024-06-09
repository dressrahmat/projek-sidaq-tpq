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
    // public $hafalanId;

    public function mount()
    {
        $this->id = auth()->user()->id;
        $this->tanggal_dibuat = Carbon::now()->format('Y-m-d');
        // $this->hafalanId = null; // Reset hafalanId setiap kali form dibuka

        // $this->changeDate();
    }

    // public function changeDate()
    // {
    //     $hafalan = Hafalan::whereHas('hafalan_user', function ($query) {
    //         $query->where('id_user', $this->id)->whereDate('hafalan_user.created_at', $this->tanggal_dibuat);
    //     })->first();
        
    //     if ($hafalan) {
    //         $this->form->setForm($hafalan);
    //         $this->hafalanId = $hafalan->id;
    //     } else {
    //         $this->form->reset();
    //         $this->hafalanId = null;
    //     }
    // }

    public function changeSurat()
    {
        $this->suratDetail = $this->suratQuranDetail($this->form->surat);
        $this->jumlahAyat = $this->suratDetail["data"]["jumlahAyat"];

        // Update ayat options
        $this->ayat = range(1, $this->jumlahAyat);
    }

    public function save()
    {
        $this->validate();
        $this->form->surat = $this->suratDetail["data"]["namaLatin"];
        DB::beginTransaction();
        try {
            $hafalan = Hafalan::whereHas('hafalan_user', function ($query){
                $query->where('id_user', $this->id)->whereNull('keterangan');
            })->count();
            // dd($hafalan);
            if ($hafalan >= 5) {
                throw new \Exception('Silahkan setorkan terlebih dahulu hafalan anda yang lain');
            }
            $simpan = $this->form->store();
            $this->dispatch('sweet-alert', icon: 'success', title: 'data berhasil disimpan');
            $this->dispatch('set-reset');
            DB::commit();
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal di simpan', text: $th->getMessage());
            DB::rollback();
        }

        $this->dispatch('refresh-data')->to(HafalanTable::class);
    }

    public function render()
    {
        $suratData = $this->suratQuran();
        $suratData = $suratData['data'];
        return view('livewire.santri.hafalan.hafalan-create', compact('suratData'));
    }
}