<?php

namespace App\Livewire\Forms;

use App\Models\Hafalan;
use Livewire\Attributes\Rule;
use Livewire\Form;

class HafalanForm extends Form
{
    public ?Hafalan $hafalan;

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

    public function setForm(Hafalan $hafalan)
    {
        $this->hafalan = $hafalan;

        $this->khidmat = $hafalan->khidmat;
        $this->entrepreneur = $hafalan->entrepreneur;
        $this->operation = $hafalan->operation;
        $this->administration = $hafalan->administration;
        $this->leadership = $hafalan->leadership;
        $this->speaking = $hafalan->speaking;
        $this->mengajar = $hafalan->mengajar;
    }

    public function store($id, $tanggal_input)
    {
        $hafalan = Hafalan::create([
            'khidmat' => $this->khidmat,
            'entrepreneur' => $this->entrepreneur,
            'operation' => $this->operation,
            'administration' => $this->administration,
            'leadership' => $this->leadership,
            'speaking' => $this->speaking,
            'mengajar' => $this->mengajar,
        ]);

        $id_user = $id; // Id user yang ingin ditambahkan ke pivot table
        $total_nilai = $hafalan->khidmat + $hafalan->entrepreneur + $hafalan->operation + $hafalan->administration + $hafalan->leadership + $hafalan->speaking + $hafalan->mengajar;

        $hafalan->hafalan_user()->attach($id_user, [
            'total_nilai' => $total_nilai,
            'created_at' => $tanggal_input,
            // 'updated_at' => $timestamp,
        ]);
        $this->reset();
    }

    public function update($id)
    {
        $this->hafalan->update([
            'khidmat' => $this->khidmat,
            'entrepreneur' => $this->entrepreneur,
            'operation' => $this->operation,
            'administration' => $this->administration,
            'leadership' => $this->leadership,
            'speaking' => $this->speaking,
            'mengajar' => $this->mengajar,
        ]);

        $timestamp = now();
        $total_nilai = $this->khidmat + $this->entrepreneur + $this->operation + $this->administration + $this->leadership + $this->speaking + $this->mengajar;

        $this->hafalan->hafalan_user()->updateExistingPivot($id, [
            'total_nilai' => $total_nilai,
        ], ['updated_at' => $timestamp]);

    }
}
