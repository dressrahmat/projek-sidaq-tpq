<?php

namespace App\Livewire\Murobbi\Santris;

use App\Livewire\Forms\KemampuanForm;
use App\Models\Kemampuan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class SantrisKemampuan extends Component
{
    public KemampuanForm $form;

    public $modalKemampuan = false;

    public $nama_santri;

    public $id;

    public $tanggal_dibuat;

    public $kemampuanId = null;

    #[On('kemampuan')]
    public function set_form(User $data)
    {
        $this->nama_santri = $data->profile->nama_lengkap;
        $this->id = $data->id;
        $this->modalKemampuan = true;
        $this->tanggal_dibuat = Carbon::now()->format('Y-m-d');
        $this->kemampuanId = null; // Reset kemampuanId setiap kali form dibuka

        $this->changeDate();
    }

    public function changeDate()
    {
        $kemampuan = Kemampuan::whereHas('kemampuan_user', function ($query) {
            $query->where('id_user', $this->id)->whereDate('kemampuan_user.created_at', $this->tanggal_dibuat);
        })->first();
        if ($kemampuan) {
            $this->form->setForm($kemampuan);
            $this->kemampuanId = $kemampuan->id;
        } else {
            $this->form->reset();
            $this->kemampuanId = null;
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
            if ($this->kemampuanId) {
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

        $this->dispatch('refresh-data')->to(SantrisTable::class);
    }

    public function render()
    {
        return view('livewire.murobbi.santris.santris-kemampuan');
    }
}
