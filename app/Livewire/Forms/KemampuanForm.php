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
        $this->entrepreneur = $kemampuan->entrepreneur;
        $this->operation = $kemampuan->operation;
        $this->administration = $kemampuan->administration;
        $this->leadership = $kemampuan->leadership;
        $this->speaking = $kemampuan->speaking;
        $this->mengajar = $kemampuan->mengajar;
    }

    public function store($id, $tanggal_input)
    {
        $kemampuan = Kemampuan::create([
            'khidmat' => $this->khidmat,
            'entrepreneur' => $this->entrepreneur,
            'operation' => $this->operation,
            'administration' => $this->administration,
            'leadership' => $this->leadership,
            'speaking' => $this->speaking,
            'mengajar' => $this->mengajar,
        ]);
        
        $id_user = $id; // Id user yang ingin ditambahkan ke pivot table
        $total_nilai = $kemampuan->khidmat + $kemampuan->entrepreneur + $kemampuan->operation + $kemampuan->administration + $kemampuan->leadership + $kemampuan->speaking + $kemampuan->mengajar;

        $kemampuan->kemampuan_user()->attach($id_user, [
            'total_nilai' => $total_nilai,
            'created_at' => $tanggal_input,
            // 'updated_at' => $timestamp,
        ]);
        $this->reset();
    }

    public function update($id)
    {
        $this->kemampuan->update([
            'khidmat' => $this->khidmat,
            'entrepreneur' => $this->entrepreneur,
            'operation' => $this->operation,
            'administration' => $this->administration,
            'leadership' => $this->leadership,
            'speaking' => $this->speaking,
            'mengajar' => $this->mengajar
        ]);

        $timestamp = now();
        $total_nilai = $this->khidmat + $this->entrepreneur + $this->operation + $this->administration + $this->leadership + $this->speaking + $this->mengajar;
        
        $this->kemampuan->kemampuan_user()->updateExistingPivot($id, [
            'total_nilai' => $total_nilai
        ], ['updated_at' => $timestamp]);

    }
}