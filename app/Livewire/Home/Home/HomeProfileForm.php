<?php

namespace App\Livewire\Home\Home;

use App\Livewire\Forms\ProfileForm;
use Illuminate\Support\Facades\DB;
use Laravolt\Indonesia\Models\City;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeProfileForm extends Component
{
    use WithFileUploads;

    public ProfileForm $form;

    public $dataKabupaten;

    public function changeProvinsi()
    {
        $this->dataKabupaten = City::where('province_code', $this->form->provinsi)->get();
    }

    public function save()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $simpan = $this->form->store();
            $this->dispatch('sweet-alert', icon: 'success', title: 'data berhasil disimpan');
            $this->dispatch('set-reset');
            DB::commit();
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal di hapus', text: $th->getMessage());
            DB::rollback();
        }

        // $this->dispatch('refresh-data')->to(MasjidsTable::class);
        return redirect()->route('beranda')->with('success', 'Anda berhasil register, tunggu konfirmasi dari admin');
    }

    public function render()
    {
        $dataProvinsi = \Indonesia::allProvinces();

        return view('livewire.home.home.home-profile-form', compact('dataProvinsi'))->layout('components.layouts.guest');
    }
}
