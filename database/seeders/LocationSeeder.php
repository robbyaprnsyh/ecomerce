<?php

namespace Database\Seeders;

use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinsis = RajaOngkir::provinsi()->all();
        foreach ($provinsis as $provinsi) {
            Provinsi::create([
                'provinsi_id' => $provinsi['province_id'],
                'provinsi' => $provinsi['province'],
            ]);
            $kotas = RajaOngkir::kota()->dariProvinsi($provinsi['province_id'])->get();
            foreach ($kotas as $kota) {
                Kota::create([
                    'provinsi_id' => $provinsi['province_id'],
                    'kota_id' => $kota['city_id'],
                    'kota' => $kota['city_name'],
                ]);
            }
        }

    }
}
