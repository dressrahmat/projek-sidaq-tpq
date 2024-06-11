<?php

namespace App\Livewire\Santri\Home;

use Livewire\Component;

class HomeMenu extends Component
{
    public function render()
    {
        return view('livewire.santri.home.home-menu')->layout('components.layouts.guest');
    }
}
