<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\MetodePembayaranSeeder;
use Database\Seeders\SubKategoriSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            KategoriSeeder::class,
            SubKategoriSeeder::class,
            LocationSeeder::class,
            // ProvinsiSeeder::class,
            // KotaSeeder::class,
            // kecamatanSeeder::class,
            MetodePembayaranSeeder::class,
        ]);

    }
}
