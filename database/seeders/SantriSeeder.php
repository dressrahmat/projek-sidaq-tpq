<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            User::factory()->count(105)->create()->each(function ($user) use (&$id_masjid) {
                $user->update(['id_masjid' => $id_masjid]);
                $user->assignRole('santri');
                
                // Increment id_masjid from 1 to 4, then reset to 1
                $id_masjid = ($id_masjid % 5) + 1;
                $id_mmurobbi = ($id_masjid % 5) + 1;
            });

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}