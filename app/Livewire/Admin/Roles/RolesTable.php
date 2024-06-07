<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesTable extends Component
{
    use WithPagination;

    #[On('refresh-data')]
    public function render()
    {
        $data = Role::latest()->paginate(5);
        return view('livewire.admin.roles.roles-table', compact('data'));
    }
}