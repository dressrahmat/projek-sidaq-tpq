<?php

namespace App\Livewire\Admin\Profile;

use App\Models\Profile;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Livewire\Forms\ProfileForm;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Province;

class ProfileEdit extends Component
{
    use WithFileUploads;
    
    public ProfileForm $form;

    public $modalEdit = false;
    
    public $dataKabupaten;
    
    public $codeProvinsi;

    #[On('edit-profile')]
    public function set_form(Profile $id)
    {
        $this->form->setForm($id);
        $codeProvinsi = Province::where('name', $this->form->provinsi)->first('code');
        $this->form->provinsi = $codeProvinsi->code;
        $codeKabupaten = City::where('name', $this->form->kabupaten)->first('code');
        $this->changeProvinsi();
        $this->form->kabupaten = $codeKabupaten->code;
        // dd($this->form->kabupaten);
        $this->modalEdit = true;
    }


    public function changeProvinsi()
    {
        $this->dataKabupaten = City::where('province_code', $this->form->provinsi)->get();
    }

    public function edit()
    {
        $this->form->provinsi = Province::where('code', $this->form->provinsi)->first()->name;
        $this->form->kabupaten = City::where('code', $this->form->kabupaten)->first()->name;
        DB::beginTransaction();
        try {
            $simpan = $this->form->update();
            $this->dispatch('sweet-alert', icon: 'success', title: 'data berhasil diupdate');
            DB::commit();
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal diupdate', text: $th->getMessage());
            DB::rollBack();
        }

        $this->dispatch('refresh-data')->to(ProfileTable::class);
    }

    public function render()
    {
        $dataProvinsi = \Indonesia::allProvinces();
        return view('livewire.admin.profile.profile-edit', compact('dataProvinsi'));
    }
}