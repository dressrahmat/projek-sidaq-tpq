<?php

namespace App\Livewire\Santri\Hafalan;

use App\Livewire\Forms\HafalanForm;
use App\Models\Hafalan;
use App\Traits\Quran;
use Livewire\Attributes\On;
use Livewire\Component;

class HafalanEdit extends Component
{
    use Quran;

    public HafalanForm $form;

    public $ayat;

    public $suratDetail;

    public $jumlahAyat;

    public $quran;

    public $modalEdit = false;

    public function mount()
    {
        $this->quran = $this->suratQuran();
    }

    #[On('form-edit')]
    public function set_form(Hafalan $id)
    {
        $this->form->setForm($id);
        $namaSuratDicari = $this->form->surat;

        foreach ($this->quran['data'] as $key => $value) {
            $data = $value;

            // Jika namaLatin pada data sesuai dengan nama surat yang dicari
            if ($data['namaLatin'] === $namaSuratDicari) {
                // Ambil nomor surat
                $this->form->surat = $data['nomor'];
                break;
            }
        }

        $this->modalEdit = true;

        $this->changeSurat();
    }

    public function changeSurat()
    {
        $this->suratDetail = $this->suratQuranDetail($this->form->surat);
        $this->jumlahAyat = $this->suratDetail['data']['jumlahAyat'];

        // Update ayat options
        $this->ayat = range(1, $this->jumlahAyat);
    }

    public function edit()
    {
        $this->form->surat = $this->suratDetail['data']['namaLatin'];
        try {
            $simpan = $this->form->update();
            $this->dispatch('sweet-alert', icon: 'success', title: 'data berhasil diupdate');
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal di hapus', text: $th->getMessage());
        }

        $this->dispatch('refresh-data')->to(HafalanTable::class);
    }

    public function render()
    {
        $suratData = $this->suratQuran();
        $suratData = $suratData['data'];

        return view('livewire.santri.hafalan.hafalan-edit', compact('suratData'));
    }
}
