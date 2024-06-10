<?php

namespace App\Livewire\Forms;

use App\Models\Hafalan;
use Livewire\Attributes\Rule;
use Livewire\Form;

class HafalanForm extends Form
{
    public ?Hafalan $hafalan;

    public $id;

    #[Rule('required', as: 'Surat')]
    public $surat;

    #[Rule('required', as: 'Awal Ayat')]
    public $awal_ayat;

    #[Rule('required', as: 'Akhir Ayat')]
    public $akhir_ayat;

    #[Rule('nullable', as: 'Keterangan')]
    public $keterangan;

    #[Rule('nullable', as: 'Status')]
    public $status;

    public function setForm(Hafalan $hafalan)
    {
        $this->hafalan = $hafalan;

        $this->surat = $hafalan->surat;
        $this->awal_ayat = $hafalan->awal_ayat;
        $this->akhir_ayat = $hafalan->akhir_ayat;
        $this->keterangan = $hafalan->keterangan;
        $this->status = $hafalan->status;
    }

    public function store()
    {
        $hafalan = Hafalan::create([
            'surat' => $this->surat,
            'awal_ayat' => $this->awal_ayat,
            'akhir_ayat' => $this->akhir_ayat,
            'keterangan' => $this->keterangan,
            'status' => $this->status,
        ]);

        $id_user = auth()->user()->id; // Id user yang ingin ditambahkan ke pivot table

        $nilai = 0;
        $hafalan->hafalan_user()->attach($id_user, [
            'nilai' => $nilai,
            'created_at' => now(),
            // 'updated_at' => $timestamp,
        ]);
        $this->reset();
    }

    public function update()
    {
        $this->hafalan->update([
            'surat' => $this->surat,
            'awal_ayat' => $this->awal_ayat,
            'akhir_ayat' => $this->akhir_ayat,
            'keterangan' => $this->keterangan,
            'status' => $this->status,
        ]);

        $timestamp = now();

        $nilai = 0;
        $id = auth()->user()->id;

        $this->hafalan->hafalan_user()->updateExistingPivot($id, [
            'nilai' => $nilai,
        ], ['updated_at' => $timestamp]);

    }
}