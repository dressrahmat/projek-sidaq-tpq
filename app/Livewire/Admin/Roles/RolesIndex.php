<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Livewire\Admin\Roles\RolesTable;

class RolesIndex extends Component
{
    public function confirmDelete($get_id)
    {
        try {
            Role::destroy($get_id);
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal di hapus', text: $th->getMessage());
        }
        $this->dispatch('refresh-data')->to(RolesTable::class);
    }
    
    public function render()
    {
        return view('livewire.admin.roles.roles-index');
    }
}