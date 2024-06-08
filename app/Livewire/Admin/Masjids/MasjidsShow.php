<?php

namespace App\Livewire\Admin\Masjids;

use App\Models\Masjid;
use Livewire\Component;

class MasjidsShow extends Component
{
    public $masjid;
    public function mount(Masjid $masjid)
    {
        $this->masjid = $masjid;
    }
    public function render()
    {
        $dataUstadz = $this->masjid->user()->whereHas('roles', function ($query) {
            $query->where('name', 'ustadz');
        })->get();
        return view('livewire.admin.masjids.masjids-show', compact('dataUstadz'));
    }
}