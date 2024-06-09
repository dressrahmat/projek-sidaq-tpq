<?php

namespace App\Livewire\Santri\Hafalan;

use App\Models\Hafalan;
use Livewire\Component;

class HafalanTable extends Component
{
    public function render()
    {
        $data = Hafalan::whereHas('hafalan_user', function ($query) {
            $query->where('id_user', auth()->user()->id);
        })->get();
        return view('livewire.santri.hafalan.hafalan-table', compact('data'));
    }
}