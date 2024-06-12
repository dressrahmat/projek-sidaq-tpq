<?php

namespace App\Livewire\Santri\Profile;

use App\Models\Profile;
use Livewire\Component;

class ProfileShow extends Component
{
    public $data;
    
    public function mount(Profile $profile)
    {
        $this->data = $profile->where('id_user', auth()->user()->id)->first();

    }
    
    public function render()
    {
        return view('livewire.santri.profile.profile-show')->layout('components.layouts.guest');
    }
}