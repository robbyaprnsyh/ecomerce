<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinsi = [
            ['provinsi' => 'DKI JAKARTA'],
            ['provinsi' => 'JAWA BARAT'],
        ];

        DB::table('provinsis')->insert($provinsi);
    }
}
