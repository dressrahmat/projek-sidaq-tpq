<?php

namespace App\Livewire\Admin\Masjids;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\MasjidForm;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Masjids\MasjidsTable;

class MasjidsCreate extends Component
{
    use WithFileUploads;
    
    public MasjidForm $form;

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

        $this->dispatch('refresh-data')->to(MasjidsTable::class);
    }
   
    public function render()
    {
        return view('livewire.admin.masjids.masjids-create');
    }
}