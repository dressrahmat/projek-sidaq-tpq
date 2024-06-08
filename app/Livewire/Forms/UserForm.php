<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;

    public $id;

    #[Rule('required|min:3', as: 'Name')]
    public $name;

    #[Rule('required|email', as: 'Email')]
    public $email;

    #[Rule('required|min:3', as: 'Password')]
    public $password;

    #[Rule('required|array')]
    public $roles;

    #[Rule('nullable')]
    public $masjid;

    public function setForm(User $user)
    {
        $this->user = $user;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->roles = $user->roles->pluck('name')->toArray();
        $this->masjid = $user->masjid->nama_masjid;
    }

    public function store()
    {
        $this->password = Hash::make($this->password);
        $user = User::create($this->except('user'));
        if ($this->masjid) {
            $user->update(['id_masjid' => $this->masjid]);
        }
        if ($this->roles) {
            $user->assignRole($this->roles);
        }
        $this->reset();
    }

    public function update()
    {
        $this->user->update($this->except('user'));

        if ($this->roles) {
            $this->user->syncRoles($this->roles);
        }
    }
}
