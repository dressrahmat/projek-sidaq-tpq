<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use App\Livewire\Forms\UserForm;
use App\Livewire\Admin\Users\UsersTable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UsersCreate extends Component
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

    public function render()
    {
        $role = Role::get();
        return view('livewire.admin.users.users-create', compact('role'));
    }
}