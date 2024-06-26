<?php

namespace App\Livewire\Santri\Hafalan;

use App\Livewire\Forms\HafalanForm;
use App\Models\Hafalan;
use App\Traits\Quran;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HafalanCreate extends Component
{
    use Quran;

    public HafalanForm $form;

    public $jumlahAyat;

    public $suratDetail;

    public $ayat;

    public $tanggal_dibuat;

    public $id;
    // public $jmlhHafalanId;

    public function mount()
    {
        $this->id = auth()->user()->id;
        $this->tanggal_dibuat = Carbon::now()->format('Y-m-d');
    }

    public function changeSurat()
    {
        $this->suratDetail = $this->suratQuranDetail($this->form->surat);
        $this->jumlahAyat = $this->suratDetail['data']['jumlahAyat'];

        // Update ayat options
        $this->ayat = range(1, $this->jumlahAyat);
    }

    public function save()
    {
        $this->validate();
        $this->form->surat = $this->suratDetail['data']['namaLatin'];
        DB::beginTransaction();
        try {
            $jmlhHafalan = Hafalan::whereHas('hafalan_user', function ($query) {
                $query->where('id_user', $this->id)->whereNull('keterangan')->orWhere('keterangan', 'ulang');
            })->count();
            
            if ($jmlhHafalan >= 5) {
                throw new \Exception('Silahkan setorkan terlebih dahulu hafalan anda yang lain');
            }

            $dataHafalan = Hafalan::whereHas('hafalan_user', function ($query) {
                $query->where('id_user', $this->id)->where('status', 1);
            })->get();


            // Memeriksa apakah ada surat yang sama dalam hasil query
            foreach ($dataHafalan as $hafalan) {
                if ($hafalan->surat == $this->form->surat) {
                    throw new \Exception('Hafalan surah ini sudah selesai');
                }
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