<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\RoleForm;
use App\Livewire\Admin\Roles\RolesTable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesEdit extends Component
{
    public RoleForm $form;

    public $modalEdit = false;

    #[ On('form-edit')]
    public function set_form(Role $id)
    {
        $this->form->setForm($id);
        $get_permissions = Permission::whereIn('id', $this->form->role->permissions->pluck('id'))->pluck('name');

        $this->dispatch('set-reset');
        $this->dispatch('set-permissions-edit', data: collect($get_permissions));
        $this->modalEdit = true;
    }

    public function edit()
    {
        try {
            $simpan = $this->form->update();
            $this->dispatch('sweet-alert', icon: 'success', title: 'data berhasil diupdate');
        } catch (\Throwable $th) {
            $this->dispatch('sweet-alert', icon: 'error', title: 'data gagal diupdate'.$th->getMessage());
        }

        $this->dispatch('refresh-data')->to(RolesTable::class);
    }
    public function render()
    {
        $permissions = Permission::get();
        return view('livewire.admin.roles.roles-edit', compact('permissions'));
    }
}