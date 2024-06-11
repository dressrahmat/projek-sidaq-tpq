<?php

namespace App\Livewire\Admin\Profile;

use App\Models\User;
use Livewire\Component;

class ProfileIndex extends Component
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
        return view('livewire.admin.profile.profile-index');
    }
}
