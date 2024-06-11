<?php

namespace App\Livewire\Admin\Profile;

use App\Livewire\Forms\UserForm;
use App\Models\Masjid;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class ProfileCreate extends Component
{
    public UserForm $form;

    public function save()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $simpan = $this->form->store();
            $this->dispatch('sweet-alert', icon: 'success', title: 'data berhasil disimpan');
            $this->dispatch('set-reset');
            DB::commit();
        } catch (\Throwable $th) {
            $this->dispatch('sweet-alert', icon: 'error', title: 'data gagal disimpan'.$th->getMessage());
            DB::rollback();
        }

        $this->dispatch('refresh-data')->to(UsersTable::class);
    }

    public function getMasjid($nama_masjid)
    {
        return collect(Masjid::select('id', 'nama_masjid')->where('nama_masjid', 'like', '%'.$nama_masjid.'%')->get());
    }

    public function render()
    {
        $role = Role::get();
        $masjids = Masjid::get();

        return view('livewire.admin.profile.profile-create', compact(['role', 'masjids']));
    }
}
