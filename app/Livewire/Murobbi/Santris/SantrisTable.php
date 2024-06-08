<?php

namespace App\Livewire\Murobbi\Santris;

use App\Models\Profile;
use Livewire\Component;

class SantrisTable extends Component
{
    public function render()
    {
        $dataSantri = Profile::whereHas('murobbi', function ($query) {
            $query->where('id_murobbi', auth()->user()->id);
        })->get();
        return view('livewire.murobbi.santris.santris-table', compact('dataSantri'));
    }
}