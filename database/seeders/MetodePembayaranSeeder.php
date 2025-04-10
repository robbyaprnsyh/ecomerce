<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metodePembayaran = [
            ['metodePembayaran' => 'BRI'],
            ['metodePembayaran' => 'BCA'],
            ['metodePembayaran' => 'CLIMB NIAGA'],
            ['metodePembayaran' => 'DANA'],
            ['metodePembayaran' => 'GOPAY'],
            ['metodePembayaran' => 'OVO'],
        ];

        DB::table('metode_pembayarans')->insert($metodePembayaran);

    }
}
