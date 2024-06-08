<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menyalin file foto profil dari sumber ke tujuan
        for ($i = 1; $i <= 5; $i++) {
            $nomor_urut = ($i % 5) + 1;

            $photoPath = 'public/uploads/images/profile/'.$nomor_urut.'.png';
            $sourceImagePath = public_path('assets/images/profile/'.$nomor_urut.'.png');

            // Pastikan file sumber tersedia sebelum menyimpan
            if (file_exists($sourceImagePath)) {
                Storage::put($photoPath, file_get_contents($sourceImagePath));
            } else {
                // Handle kesalahan jika file sumber tidak ditemukan
                echo "File sumber tidak ditemukan untuk nomor urut $nomor_urut.";
            }
        }

        DB::beginTransaction();
        try {
            $id_masjid = 1;
            $urutan_profile = 1;

            User::factory()
                ->count(15)
                ->create()
                ->each(function ($user) use (&$id_masjid, &$urutan_profile) {
                    // Membuat profile baru untuk setiap pengguna
                    $profile = Profile::factory()->create([
                        'id_user' => $user->id, // Hubungkan profile ke user
                        'photo_profile' => 'uploads/images/profile/'.($urutan_profile % 5 + 1).'.png',
                    ]);

                    // Mengupdate pengguna dengan id_masjid
                    $user->update([
                        'id_masjid' => $id_masjid,
                    ]);

                    // Menetapkan peran admin ke pengguna
                    $user->assignRole('admin');

                    // Increment id_masjid dari 1 ke 5, kemudian reset ke 1
                    $id_masjid = ($id_masjid % 5) + 1;

                    // Increment urutan_profile
                    $urutan_profile++;
                });

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
