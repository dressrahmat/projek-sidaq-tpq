<?php

namespace App\Livewire\Admin\Permissions;

use App\Livewire\Forms\PermissionForm;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionsEdit extends Component
{
    public PermissionForm $form;

    public $modalEdit = false;

    #[On('form-edit')]
    public function set_form(Permission $id)
    {
        $this->form->setForm($id);

        $this->modalEdit = true;
    }

    public function edit()
    {

        try {
            $simpan = $this->form->update();
            $this->dispatch('sweet-alert', icon: 'success', title: 'data berhasil diupdate');
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal di hapus', text: $th->getMessage());
        }

        $this->dispatch('refresh-data')->to(PermissionsTable::class);
    }

    public function render()
    {
        return view('livewire.admin.permissions.permissions-edit');
    }
}
