<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama' => 'Tinggi Tiang',
                'kode_kriteria' => 'C1',
                'bobot' => '10',
                'tipe' => 'cost'
            ],
            [
                'nama' => 'Pencahayaan',
                'kode_kriteria' => 'C2',
                'bobot' => '20',
                'tipe' => 'benefit'
            ],
            [
                'nama' => 'Jarak Pandang Ideal',
                'kode_kriteria' => 'C3',
                'bobot' => '30',
                'tipe' => 'benefit'
            ],
            [
                'nama' => 'Jenis Persimpangan',
                'kode_kriteria' => 'C4',
                'bobot' => '40',
                'tipe' => 'benefit'
            ],
        ];

        foreach ($data as $item) {
            Kriteria::create($item);
        }
    }
}
