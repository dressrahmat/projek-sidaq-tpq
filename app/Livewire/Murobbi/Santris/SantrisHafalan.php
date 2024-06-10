<?php

namespace App\Livewire\Murobbi\Santris;

use App\Livewire\Forms\HafalanForm;
use App\Models\Hafalan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class SantrisHafalan extends Component
{
    public HafalanForm $form;

    public $modalHafalan = false;

    public $nama_santri;

    public $hafalan;

    public $id;

    public $status = [];

    public $keterangan = [];

    #[On('hafalan')]
    public function set_form(User $data)
    {
        $this->nama_santri = $data->profile->nama_lengkap;
        $this->id = $data->id;
        $this->modalHafalan = true;

        $this->hafalan = Hafalan::whereHas('hafalan_user', function ($query) {
            $query->where('id_user', $this->id)->whereNull('keterangan')->orWhere('keterangan', 'ulang');
        })->get();

        foreach ($this->hafalan as $key => $value) {
            $this->keterangan[$value->id] = $value->keterangan;
        }

    }
    

    public function changeKeterangan($id)
    {
        $hafalan = Hafalan::findOrFail($id);
        if ($this->keterangan[$id] != "") {
            $hafalan->update([
                'keterangan' => $this->keterangan[$id]
            ]);
            $this->dispatch('sweet-alert', icon: 'success', title: 'Data berhasil diupdate');
        }

    }

    public function changeStatus($id)
    {
        $hafalan = Hafalan::findOrFail($id);
        
        if ($hafalan->keterangan == "lanjut") {
            $hafalan->update([
                'status' => $this->status[$id]
            ]);
            $this->dispatch('sweet-alert', icon: 'success', title: 'Data berhasil diupdate');
        }

    }

    public function save()
    {
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
                // Create new hafalan
                $this->form->store($this->id, $this->tanggal_dibuat);
                $this->dispatch('sweet-alert', icon: 'success', title: 'Data berhasil disimpan');
            }

            DB::commit();
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'Data gagal disimpan', text: $th->getMessage());
            DB::rollback();
        }

        $this->dispatch('refresh-data')->to(SantrisTable::class);
    }

    public function render()
    {
        // dd($hafalan);
        return view('livewire.murobbi.santris.santris-hafalan');
    }
}