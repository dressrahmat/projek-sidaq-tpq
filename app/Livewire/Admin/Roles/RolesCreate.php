<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use App\Livewire\Forms\RoleForm;
use App\Livewire\Admin\Roles\RolesTable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RolesCreate extends Component
{
    public RoleForm $form;

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

        $this->dispatch('refresh-data')->to(RolesTable::class);
    }

    public function render()
    {
        $permissions = Permission::get();
        return view('livewire.admin.roles.roles-create', compact('permissions'));
    }
}