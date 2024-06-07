<?php

namespace App\Livewire\Admin\Masjids;

use App\Models\Masjid;
use Livewire\Component;
use Livewire\Attributes\On;

class MasjidsTable extends Component
{
    #[On('refresh-data')]
    public function render()
    {
        $data = Masjid::latest()->paginate(5);
        return view('livewire.admin.masjids.masjids-table', compact('data'));
    }
}