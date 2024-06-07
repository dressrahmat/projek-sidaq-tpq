<?php

namespace App\Livewire\Admin\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use App\Livewire\Admin\Permissions\PermissionsTable;

class PermissionsIndex extends Component
{
    public function confirmDelete($get_id)
    {
        try {
            Permission::destroy($get_id);
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal di hapus', text: $th->getMessage());
        }
        $this->dispatch('refresh-data')->to(PermissionsTable::class);
    }
    
    public function render()
    {
        return view('livewire.admin.permissions.permissions-index');
    }
}