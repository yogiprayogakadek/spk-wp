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

        $users = [
            [
                'nama' => 'Putu',
                'no_hp' => '081234123423',
                'foto' => 'assets/uploads/users/default.png',
                'email' => 'putu@gmail.com',
                'password' => bcrypt('12345678')
            ],
            [
                'nama' => 'Kadek',
                'no_hp' => '081234123423',
                'foto' => 'assets/uploads/users/default.png',
                'email' => 'kadek@gmail.com',
                'password' => bcrypt('12345678')
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
