<?php

namespace Database\Seeders;

use App\Models\Masjid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasjidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $masjids = [
            [
                'nama_masjid' => 'Masjid Al-Hidayah',
            ],
            [
                'nama_masjid' => 'Masjid Baitul Mubtadiin',
            ],
            [
                'nama_masjid' => 'Masjid Al Falah',
            ],
            [
                'nama_masjid' => 'Masjid Ar Rahman',
            ],
            [
                'nama_masjid' => 'Masjid Sejuta Pemuda',
            ],
        ];

        DB::beginTransaction();
        try {

            for ($i = 1; $i <= 5; $i++) {
                // Menggunakan operator modulo untuk memastikan urutan dari 1 hingga 4
                $nomor_urut = ($i % 5) + 1;

                $photoPath = '/public/uploads/images/masjid/'.$nomor_urut.'.png';
                $sourceImagePath = public_path('/assets/images/masjid/'.$nomor_urut.'.png');

                // Pastikan file sumber tersedia sebelum menyimpan
                if (file_exists($sourceImagePath)) {
                    Storage::put($photoPath, file_get_contents($sourceImagePath));
                } else {
                    // Handle kesalahan jika file sumber tidak ditemukan
                    echo "File sumber tidak ditemukan untuk nomor urut $nomor_urut.";
                }
            }

            $urutan = 0;
            foreach ($masjids as $masjid) {
                $masjid['photo_masjid'] = 'uploads/images/masjid/'.($urutan++ % 5) + 1 .'.png';
                Masjid::create($masjid);
            }

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}