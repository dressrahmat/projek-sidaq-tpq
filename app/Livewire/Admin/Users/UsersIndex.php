<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use App\Livewire\Admin\Users\UsersTable;

class UsersIndex extends Component
{
    public function confirmDelete($get_id)
    {
        try {
            User::destroy($get_id);
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal di hapus', text: $th->getMessage());
        }
        $this->dispatch('refresh-data')->to(UsersTable::class);
    }
    public function render()
    {
        return view('livewire.admin.users.users-index');
    }
}