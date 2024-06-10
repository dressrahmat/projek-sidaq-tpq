<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UstadzSeeder extends Seeder
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

            // Membuat 15 user dengan peran 'ustadz'
            $ustadzUsers = User::factory()
                ->count(15)
                ->create()
                ->each(function ($user) use (&$id_masjid) {
                    static $urutan = 1;
                    // Membuat profile baru untuk setiap pengguna
                    $profile = Profile::factory()->create([
                        'id_user' => $user->id, // Hubungkan profile ke user
                        'photo_profile' => 'uploads/images/profile/'.($urutan % 5 + 1).'.png',
                    ]);

                    // Mengupdate pengguna dengan id_masjid
                    $user->update([
                        'id_masjid' => $id_masjid,
                    ]);

                    // Menetapkan peran ustadz ke pengguna
                    $user->assignRole('ustadz');

                    // Increment id_masjid dari 1 ke 5, kemudian reset ke 1
                    $id_masjid = ($id_masjid % 5) + 1;

                    // Increment urutan_profile
                    $urutan++;
                });

            // Convert Collection to Array for Indexed Access
            $ustadzUsersArray = $ustadzUsers->toArray();

            // Membuat 105 user dengan peran 'santri'
            $id_masjid = 1;
            $id_murobbi_index = 0;
            User::factory()
                ->count(105)
                ->create()
                ->each(function ($user) use (&$id_masjid, &$id_murobbi_index, $ustadzUsersArray) {
                    static $urutan = 1;

                    // Membuat profile baru untuk setiap pengguna
                    $profile = Profile::factory()->create([
                        'id_user' => $user->id, // Hubungkan profile ke user
                        'id_murobbi' => $ustadzUsersArray[$id_murobbi_index]['id'], // Set id_murobbi secara berurutan
                        'photo_profile' => 'uploads/images/profile/'.($urutan % 5 + 1).'.png',
                    ]);

                    // Mengupdate pengguna dengan id_masjid
                    $user->update([
                        'id_masjid' => $id_masjid,
                    ]);

                    // Menetapkan peran santri ke pengguna
                    $user->assignRole('santri');

                    // Increment id_masjid dari 1 ke 5, kemudian reset ke 1
                    $id_masjid = ($id_masjid % 5) + 1;

                    // Increment id_murobbi_index dari 0 ke 14, kemudian reset ke 0
                    $id_murobbi_index = ($id_murobbi_index + 1) % 15;

                    // Increment urutan_profile
                    $urutan++;
                });

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}