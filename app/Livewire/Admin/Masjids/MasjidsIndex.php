<?php

namespace App\Livewire\Admin\Masjids;

use App\Models\Masjid;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Admin\Masjids\MasjidsTable;

class MasjidsIndex extends Component
{
    public function confirmDelete($get_id)
    {
        try {
            $masjid = Masjid::find($get_id);
            // Hapus gambar lama jika ada
            $oldPhotoPath = $masjid->photo_masjid;
            if ($oldPhotoPath && Storage::disk('public')->exists($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);
                Masjid::destroy($get_id);
            }


        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal di hapus', text: $th->getMessage());
        }
        $this->dispatch('refresh-data')->to(MasjidsTable::class);
    }
    
    public function render()
    {
        return view('livewire.admin.masjids.masjids-index');
    }
}