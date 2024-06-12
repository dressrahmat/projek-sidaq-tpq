<?php

namespace App\Livewire\Santri\Hafalan;

use App\Models\Hafalan;
use Livewire\Attributes\On;
use Livewire\Component;

class HafalanTable extends Component
{
    public $filter = 'Belum Disetorkan';

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->render();
    }

    #[On('refresh-data')]
    public function render()
    {
        $data = Hafalan::whereHas('hafalan_user', function ($query) {
            $query->where('id_user', auth()->user()->id);
        });

        if ($this->filter == 'Belum Disetorkan') {
            $data->whereNull('keterangan')->orWhere('keterangan', 'ulang');
        } elseif ($this->filter == 'Sudah Disetorkan') {
            $data->where('keterangan', 'lanjut');
        } elseif ($this->filter == 'Surat Selesai') {
            $data->where('status', true);
        }

        $data = $data->get();

        return view('livewire.santri.hafalan.hafalan-table', compact('data'));
    }
}
