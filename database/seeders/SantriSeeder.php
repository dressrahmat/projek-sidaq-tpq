<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            $id_masjid = 1;
            User::factory()
                ->count(105)
                ->create()
                ->each(function ($user) use ($id_masjid) {
                    // Membuat profile baru untuk setiap pengguna
                    $profile = Profile::factory()->create([
                        'id_user' => $user->id, // Hubungkan profile ke user
                    ]);

                    // Mengupdate pengguna dengan id_masjid
                    $user->update([
                        'id_masjid' => $id_masjid,
                    ]);

                    // Mengupdate pengguna dengan id_masjid
                    $profile->update([
                        'id_murobbi' => $id_murobbi,
                    ]);

                    // Menetapkan peran admin ke pengguna
                    $user->assignRole('ustadz');

                    // Increment id_masjid dari 1 ke 4, kemudian reset ke 1
                    $id_masjid = ($id_masjid % 5) + 1;
                    $id_murobbi = ($id_masjid % 15) + 1;
                });

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
