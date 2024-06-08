<?php

namespace App\Livewire\Admin\Permissions;

use App\Livewire\Forms\PermissionForm;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PermissionsCreate extends Component
{
    public PermissionForm $form;

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
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal di hapus', text: $th->getMessage());
            DB::rollback();
        }

        $this->dispatch('refresh-data')->to(PermissionsTable::class);
    }

    public function render()
    {
        return view('livewire.admin.permissions.permissions-create');
    }
}
