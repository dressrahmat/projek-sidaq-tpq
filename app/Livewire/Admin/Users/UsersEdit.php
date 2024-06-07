<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\UserForm;
use App\Livewire\Admin\Users\UsersTable;
use Spatie\Permission\Models\Role;

class UsersEdit extends Component
{
    public UserForm $form;

    public $modalEdit = false;

    #[On('form-edit')]
    public function set_form(User $id)
    {
        $this->form->setForm($id);
        $get_roles = Role::whereIn('id', $this->form->user->roles->pluck('id'))->pluck('name');
        
        $this->dispatch('set-reset');
        $this->dispatch('set-roles-edit', data: collect($get_roles));
        $this->modalEdit = true;
    }

    public function edit()
    {
        try {
            $simpan = $this->form->update();
            $this->dispatch('sweet-alert', icon: 'success', title: 'data berhasil diupdate');
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal diupdate', text: $th->getMessage());
        }

        $this->dispatch('refresh-data')->to(UsersTable::class);
    }
    public function render()
    {
        $data = Role::get();
        return view('livewire.admin.users.users-edit', compact('data'));
    }
}