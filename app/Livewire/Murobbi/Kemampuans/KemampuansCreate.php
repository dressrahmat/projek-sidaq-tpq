<?php

namespace App\Livewire\Murobbi\Kemampuans;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use App\Livewire\Forms\KemampuanForm;
use Spatie\Kemampuan\Models\Kemampuan;
use App\Livewire\Admin\Kemampuans\KemampuansTable;

class KemampuansCreate extends Component
{
    public KemampuanForm $form;

    public $modalCreate = false;
    public $nama_santri;
    public $id;

    #[On('kemampuan')]
    public function set_form(User $data)
    {
        $this->nama_santri = $data->profile->nama_lengkap;
        $this->id = $data->id;
        $this->modalCreate = true;
    }

    public function save()
    {
        DB::beginTransaction();
        try {
            $simpan = $this->form->store($this->id);
            $this->dispatch('sweet-alert', icon: 'success', title: 'data berhasil disimpan');
            DB::commit();
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal di hapus', text: $th->getMessage());
            DB::rollback();
        }

        // $this->dispatch('refresh-data')->to(KemampuansTable::class);
    }
    public function render()
    {
        return view('livewire.murobbi.kemampuans.kemampuans-create');
    }
}