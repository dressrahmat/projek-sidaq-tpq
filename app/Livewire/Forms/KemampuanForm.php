<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Kemampuan;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class KemampuanForm extends Form
{
    public ?Kemampuan $kemampuan;

    public $id;

    #[Rule('required', as: 'Khidmat')]
    public $khidmat;

    #[Rule('required', as: 'Entrepreneur')]
    public $entrepreneur;

    #[Rule('required', as: 'Operation')]
    public $operation;

    #[Rule('required', as: 'Administration')]
    public $administration;

    #[Rule('required', as: 'Leadership')]
    public $leadership;

    #[Rule('required', as: 'Speaking')]
    public $speaking;

    #[Rule('required', as: 'Mengajar')]
    public $mengajar;


    public function setForm(Kemampuan $kemampuan)
    {
        $this->kemampuan = $kemampuan;

        $this->khidmat = $kemampuan->khidmat;
    }

    public function store($id)
    {
        $kemampuan = Kemampuan::create([
            'khidmat' => $this->khidmat,
            'entrepreneur' => $this->entrepreneur,
            'operation' => $this->operation,
            'administration' => $this->administration,
            'leadership' => $this->leadership,
            'speaking' => $this->speaking,
            'mengajar' => $this->mengajar
        ]);
        
        $kemampuan->kemampuan_user()->attach($id);
        $this->reset();
    }

    public function update()
    {
        $this->kemampuan->update($this->except('kemampuan'));
    }
}