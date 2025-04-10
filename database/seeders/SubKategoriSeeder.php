<?php

namespace Database\Seeders;

use App\Models\SubKategori;
use Illuminate\Database\Seeder;

class SubKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubKategori::create([
            'kategori_id' => 1,
            'name' => 'T-Shirt',
        ]);

        SubKategori::create([
            'kategori_id' => 1,
            'name' => 'Shirt',
        ]);

        SubKategori::create([
            'kategori_id' => 1,
            'name' => 'Sweater',
        ]);

        SubKategori::create([
            'kategori_id' => 1,
            'name' => 'Jacket',
        ]);

        SubKategori::create([
            'kategori_id' => 1,
            'name' => 'Pants',
        ]);

        // SubKategori::create([
        //     'kategori_id' => 1,
        //     'name' => 'Accessories',
        // ]);

        SubKategori::create([
            'kategori_id' => 2,
            'name' => 'T-Shirt',
        ]);

        SubKategori::create([
            'kategori_id' => 2,
            'name' => 'Shirt',
        ]);

        SubKategori::create([
            'kategori_id' => 2,
            'name' => 'Sweater',
        ]);

        SubKategori::create([
            'kategori_id' => 2,
            'name' => 'Jacket',
        ]);

        SubKategori::create([
            'kategori_id' => 2,
            'name' => 'Pants',
        ]);

        // SubKategori::create([
        //     'kategori_id' => 2,
        //     'name' => 'Accessories',
        // ]);

        // SubKategori::create([
        //     'kategori_id' => 3,
        //     'name' => 'T-Shirt',
        // ]);

        // SubKategori::create([
        //     'kategori_id' => 3,
        //     'name' => 'Shirt',
        // ]);

        // SubKategori::create([
        //     'kategori_id' => 3,
        //     'name' => 'Sweater',
        // ]);

        // SubKategori::create([
        //     'kategori_id' => 3,
        //     'name' => 'Jacket',
        // ]);

        // SubKategori::create([
        //     'kategori_id' => 3,
        //     'name' => 'Pants',
        // ]);

        // SubKategori::create([
        //     'kategori_id' => 3,
        //     'name' => 'Accessories',
        // ]);

    }
}
