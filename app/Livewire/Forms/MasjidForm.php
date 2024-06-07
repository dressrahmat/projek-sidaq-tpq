<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Masjid;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class MasjidForm extends Form
{
    public ?Masjid $masjid;

    public $id;

    #[Rule('required|min:3', as: 'Nama Jenis Paket')]
    public $nama_masjid;

    #[Rule('required|image|max:2024|mimes:jpg,jpeg,png|dimensions:width=1080,height=1080', as: 'Photo Kategori')]
    public $photo_masjid;

    public function setForm(Masjid $masjid)
    {
        $this->masjid = $masjid;

        $this->photo_masjid = $masjid->photo_masjid;
        $this->nama_masjid = $masjid->nama_masjid;
    }

    public function store()
    {
        $masjid = Masjid::create([
            'nama_masjid' => $this->nama_masjid,
        ]);
        
        if ($this->photo_masjid) {
            // Periksa jika gambar diunggah dan merupakan instance dari UploadedFile
            $folderPath = 'uploads/images/masjid/';
            $fileName = time() . '.' . $this->photo_masjid->getClientOriginalExtension();
            $this->photo_masjid->storeAs('public/' . $folderPath, $fileName);
            $this->photo_masjid = 'storage/' . $folderPath . $fileName;

            $masjid->update([
                'photo_masjid' => $this->photo_masjid,
            ]);
        }


        $this->reset();
    }

    public function update()
    {
        $this->masjid->update([
            'nama_masjid' => $this->nama_masjid,
        ]);

        if (!is_string($this->photo_masjid)) {
            // Periksa jika gambar diunggah dan merupakan instance dari UploadedFile
            $folderPath = 'uploads/images/masjid/';
            $fileName = time() . '.' . $this->photo_masjid->getClientOriginalExtension();
            $this->photo_masjid->storeAs('public/' . $folderPath, $fileName);
            $this->photo_masjid = 'storage/' . $folderPath . $fileName;

            // Hapus gambar lama jika ada
            $oldPhotoPath = $this->masjid->photo_masjid;
            if ($oldPhotoPath && Storage::exists($oldPhotoPath)) {
                Storage::delete($oldPhotoPath);
            }

            $this->masjid->update([
                'photo_masjid' => $this->photo_masjid,
            ]);
        }
    }
}