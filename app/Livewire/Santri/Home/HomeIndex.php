<?php

namespace App\Livewire\Santri\Home;

use Livewire\Component;

class HomeIndex extends Component
{
    public function render()
    {
        return view('livewire.santri.home.home-index')->layout('components.layouts.guest');
    }
}
