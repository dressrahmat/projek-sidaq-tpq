<?php

namespace App\Livewire\Home\Home;

use Livewire\Component;

class HomeIndex extends Component
{
    public function render()
    {
        return view('livewire.home.home.home-index')->layout('components.layouts.guest');
    }
}
