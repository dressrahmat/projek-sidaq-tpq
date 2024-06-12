<?php

namespace App\Livewire\Admin\Profile;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ProfilePilihMurobbi extends Component
{
    public $aktif = false;

    public $data;

    #[On('pilih-murobbi')]
    public function pilihMurobbi($data)
    {
        $this->aktif = true;
        $this->data = $data;
    }

    public function pilihUstadz($id)
    {

        DB::beginTransaction();
        try {
            $simpan = Profile::whereIn('id', $this->data)->update([
                'id_murobbi' => $id,
            ]);
            $this->dispatch('sweet-alert', icon: 'success', title: 'data berhasil disimpan');
            $this->dispatch('set-reset');
            DB::commit();
        } catch (\Throwable $th) {
            $this->dispatch('modal-sweet-alert', icon: 'error', title: 'data gagal disimpan', text: $th->getMessage());
            DB::rollback();
        }

        $this->dispatch('refresh-data')->to(ProfileTable::class);
        $this->aktif = false;

    }

    public function render()
    {
        $dataUstadz = User::role('ustadz')->where('id_masjid', auth()->user()->id_masjid)->get();

        return view('livewire.admin.profile.profile-pilih-murobbi', compact('dataUstadz'));
    }
}
