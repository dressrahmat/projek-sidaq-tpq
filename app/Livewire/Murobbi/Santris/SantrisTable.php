<?php

namespace App\Livewire\Murobbi\Santris;

use App\Models\Profile;
use Livewire\Component;
use Livewire\Attributes\On;

class SantrisTable extends Component
{
    #[On('refresh-data')]
    public function render()
    {
        $dataSantri = Profile::whereHas('murobbi', function ($query) {
            $query->where('id_murobbi', auth()->user()->id);
        })->get();
        return view('livewire.murobbi.santris.santris-table', compact('dataSantri'));
    }
}