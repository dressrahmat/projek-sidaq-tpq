<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => bcrypt(4444),
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();
        try {
            Permission::create(['name' => 'baca']);
            Permission::create(['name' => 'edit']);
            Permission::create(['name' => 'hapus']);
            Permission::create(['name' => 'buat']);

            Role::create(['name' => 'superadmin']);
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'ustadz']);
            Role::create(['name' => 'santri']);

            $superadmin = User::create(array_merge([
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
            ], $default_user_value));

            $superadmin->assignRole('superadmin');

            $admin = User::create(array_merge([
                'id_masjid' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
            ], $default_user_value));

            $admin->assignRole('admin');

            $ustadz = User::create(array_merge([
                'id_masjid' => 1,
                'name' => 'ustadz',
                'email' => 'ustadz@gmail.com',
            ], $default_user_value));

            $ustadz->assignRole('ustadz');

            Profile::create([
                'id_user' => $ustadz->id,
                'photo_profile' => 'uploads/images/profile/1.png',
                'nama_lengkap' => 'Ustadz. Dr. Ir. H. Nurhakim, M. Sc.',
                'tanggal_lahir' => '1970-01-01',
                'jenis_kelamin' => 'L',
                'amanah' => 'Ketua Masjid Al-Hikmah',
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Bandung',
                'alamat' => 'Jl. Ir. H. Nurhakim',
            ]);

            $santri = User::create(array_merge([
                'id_masjid' => 1,
                'name' => 'santri',
                'email' => 'santri@gmail.com',
            ], $default_user_value));

            $santri->assignRole('santri');

            Profile::create([
                'id_user' => $santri->id,
                'id_murobbi' => $ustadz->id,
                'photo_profile' => 'uploads/images/profile/3.png',
                'nama_lengkap' => 'Dedy Setiawan',
                'tanggal_lahir' => '2002-09-11',
                'jenis_kelamin' => 'L',
                'amanah' => 'Pj Amal Sosial',
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Bandung',
                'alamat' => 'Jl. Ir. H. Nurhakim',
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}