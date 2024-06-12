<?php

namespace App\Livewire\Forms;

use App\Models\Profile;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ProfileForm extends Form
{
    public ?Profile $profile;

    public $id;

    #[Rule('required', as: 'Nama Lengkap')]
    public $nama_lengkap;

    #[Rule('required', as: 'Tanggal Lahir')]
    public $tanggal_lahir;

    #[Rule('required', as: 'Jenis Kelamin')]
    public $jenis_kelamin;

    #[Rule('nullable', as: 'Amanah')]
    public $amanah;

    #[Rule('required', as: 'Provinsi')]
    public $provinsi;

    #[Rule('required', as: 'Kabupaten')]
    public $kabupaten;

    #[Rule('required', as: 'Alamat')]
    public $alamat;

    #[Rule('required|image|max:2024|mimes:jpg,jpeg,png|dimensions:width=1080,height=1080', as: 'Photo Profile')]
    public $photo_profile;

    public $admin;

    public function setForm(Profile $profile)
    {
        $this->profile = $profile;

        $this->photo_profile = $profile->photo_profile;
        $this->nama_lengkap = $profile->nama_lengkap;
    }

    public function store()
    {
        $profile = Profile::create([
            'id_user' => auth()->user()->id,
            'nama_lengkap' => $this->nama_lengkap,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'amanah' => $this->amanah,
            'provinsi' => $this->provinsi,
            'kabupaten' => $this->kabupaten,
            'alamat' => $this->alamat,
        ]);

        if ($this->photo_profile) {
            // Periksa jika gambar diunggah dan merupakan instance dari UploadedFile
            $folderPath = 'uploads/images/profile/';
            $fileName = time().'.'.$this->photo_profile->getClientOriginalExtension();
            $this->photo_profile->storeAs('public/'.$folderPath, $fileName);
            $this->photo_profile = $folderPath.$fileName;

            $profile->update([
                'photo_profile' => $this->photo_profile,
            ]);
        }

        $this->reset();
    }

    public function update()
    {
        $this->profile->update([
            'nama_profile' => $this->nama_profile,
        ]);

        if (! is_string($this->photo_profile)) {
            // Periksa jika gambar diunggah dan merupakan instance dari UploadedFile
            $folderPath = 'uploads/images/profile/';
            $fileName = time().'.'.$this->photo_profile->getClientOriginalExtension();
            $this->photo_profile->storeAs('public/'.$folderPath, $fileName);
            $this->photo_profile = $folderPath.$fileName;

            // Hapus gambar lama jika ada
            $oldPhotoPath = $this->profile->photo_profile;
            if ($oldPhotoPath && Storage::disk('public')->exists($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);
                $this->profile->update([
                    'photo_profile' => $this->photo_profile,
                ]);
            }
        }
    }
}
