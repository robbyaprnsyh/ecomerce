<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Ujang',
            'email' => 'ujang@gmail.com',
            'email_verified_at' => now(),
            'no_telepon' => '083948938402',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2000-10-10',
            'password' => Hash::make('12345678'),
        ]);
    }
}
