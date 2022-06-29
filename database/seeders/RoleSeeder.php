<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = [
            'Admin', 'Ketua', 'Sekretaris', 'Bendahara', 'Anggota'
        ];

        foreach($jabatan as $jabatan) {
            Jabatan::create([
                'nama_jabatan' => $jabatan
            ]);
        }
    }
}
