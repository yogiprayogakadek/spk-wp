<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = Jabatan::where('nama_jabatan', '!=', 'Anggota')->get();

        $users = [
            [
                'id_jabatan' => $jabatan[0]->id_jabatan,
                'nama' => 'Administrator',
                'tempat_lahir' => 'Badung',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 1,
                'no_hp' => '0812341234',
                'alamat' => 'Jl. Sidakarya No. 1',
                'foto' => 'assets/uploads/users/default.png',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678')
            ],
            [
                'id_jabatan' => $jabatan[1]->id_jabatan,
                'nama' => 'Ketua',
                'tempat_lahir' => 'Badung',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 1,
                'no_hp' => '0812341234',
                'alamat' => 'Jl. Sidakarya',
                'foto' => 'assets/uploads/users/default.png',
                'email' => 'ketua@gmail.com',
                'password' => bcrypt('12345678')
            ],
            [
                'id_jabatan' => $jabatan[2]->id_jabatan,
                'nama' => 'Sekretaris',
                'tempat_lahir' => 'Badung',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 1,
                'no_hp' => '0812341234',
                'alamat' => 'Jl. Sidakarya',
                'foto' => 'assets/uploads/users/default.png',
                'email' => 'sekretaris@gmail.com',
                'password' => bcrypt('12345678')
            ],
            [
                'id_jabatan' => $jabatan[3]->id_jabatan,
                'nama' => 'Bendahara',
                'tempat_lahir' => 'Badung',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 1,
                'no_hp' => '0812341234',
                'alamat' => 'Jl. Sidakarya',
                'foto' => 'assets/uploads/users/default.png',
                'email' => 'bendahara@gmail.com',
                'password' => bcrypt('12345678'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
