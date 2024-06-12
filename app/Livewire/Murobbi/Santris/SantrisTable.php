<?php

namespace App\Livewire\Murobbi\Santris;

use App\Models\Profile;
use Livewire\Attributes\On;
use Livewire\Component;

class SantrisTable extends Component
{
    #[On('refresh-data')]
    public function render()
    {
        $dataSantri = Profile::whereHas('user.roles', function($query){
            $query->where('name', 'santri');
        })->whereHas('murobbi', function ($query) {
            $query->where('id_murobbi', auth()->user()->id);
        })->get();

        return view('livewire.murobbi.santris.santris-table', compact('dataSantri'));
    }
}