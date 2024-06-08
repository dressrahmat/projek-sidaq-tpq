<?php

namespace App\Livewire\Santri\Hafalan;

use Livewire\Component;

class HafalanIndex extends Component
{
    public function render()
    {
        return view('livewire.santri.hafalan.hafalan-index')->layout('components.layouts.guest');
    }
}
