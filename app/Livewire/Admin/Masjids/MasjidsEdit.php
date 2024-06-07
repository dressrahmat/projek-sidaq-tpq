<?php

namespace App\Livewire\Admin\Masjids;

use App\Models\Masjid;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Livewire\Forms\MasjidForm;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Masjids\MasjidsTable;

class MasjidsEdit extends Component
{
    use WithFileUploads;
    
    public MasjidForm $form;

    public $modalEdit = false;

    #[On('form-edit')]
    public function set_form(Masjid $id)
    {
        $this->form->setForm($id);

        $this->modalEdit = true;
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