<?php
namespace Database\Seeders;

use App\Models\Ukuran;
use Illuminate\Database\Seeder;

class UkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ukuran::create([
            'ukuran' => 'S',
        ]);
        Ukuran::create([
            'ukuran' => 'M',
        ]);
        Ukuran::create([
            'ukuran' => 'L',
        ]);
        Ukuran::create([
            'ukuran' => 'XL',
        ]);
        Ukuran::create([
            'ukuran' => 'XXL',
        ]);
    }
}
