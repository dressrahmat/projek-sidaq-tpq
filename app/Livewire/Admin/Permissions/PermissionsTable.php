<?php

namespace App\Livewire\Admin\Permissions;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionsTable extends Component
{
    use WithPagination;

    #[On('refresh-data')]
    public function render()
    {
        $data = Permission::latest()->paginate(5);
        return view('livewire.admin.permissions.permissions-table', compact('data'));
    }
}