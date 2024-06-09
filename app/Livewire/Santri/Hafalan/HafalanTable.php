<?php

namespace App\Livewire\Santri\Hafalan;

use App\Models\Hafalan;
use Livewire\Component;
use Livewire\Attributes\On;

class HafalanTable extends Component
{
    #[On('refresh-data')]
    public function render()
    {
        $data = Hafalan::whereHas('hafalan_user', function ($query) {
            $query->where('id_user', auth()->user()->id);
        })->get();
        return view('livewire.santri.hafalan.hafalan-table', compact('data'));
    }
}