<?php

namespace App\Livewire\Admin\Masjids;

use App\Livewire\Forms\MasjidForm;
use App\Models\Masjid;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class MasjidsEdit extends Component
{
    use WithFileUploads;

    public MasjidForm $form;

    public $modalEdit = false;

    #[On('form-edit')]
    public function set_form(Masjid $id)
    {
        $this->form->setForm($id);

        $get_admin = User::select('id', 'name')->where('id', $this->form->admin->id)->first();

        $this->dispatch('set-admin', id: $this->form->admin->id, data: collect($get_admin));

        $this->modalEdit = true;
    }

    public function getUser($name)
    {
        return collect(User::select('id', 'name')->where('name', 'like', '%'.$name.'%')->whereNull('id_masjid')->get());
    }

    public function edit()
    {
        DB::beginTransaction();
        try {
            $simpan = $this->form->update();
            $this->dispatch('sweet-alert', icon: 'success', title: 'data berhasil diupdate');
            DB::commit();
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal di hapus', text: $th->getMessage());
            DB::rollBack();
        }

        $this->dispatch('refresh-data')->to(MasjidsTable::class);
    }

    public function render()
    {
        return view('livewire.admin.masjids.masjids-edit');
    }
}
