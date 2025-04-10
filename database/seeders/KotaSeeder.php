<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kota = [
            ['provinsi_id' => 1, 'kota' => 'KABUPATEN KEPULAUAN SERIBU'],
            ['provinsi_id' => 1, 'kota' => 'KOTA JAKARTA SELATAN'],
            ['provinsi_id' => 1, 'kota' => 'KOTA JAKARTA TIMUR'],
            ['provinsi_id' => 1, 'kota' => 'KOTA JAKARTA PUSAT'],
            ['provinsi_id' => 1, 'kota' => 'KOTA JAKARTA BARAT'],
            ['provinsi_id' => 1, 'kota' => 'KOTA JAKARTA UTARA'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN BOGOR'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN SUKABUMI'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN CIANJUR'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN BANDUNG'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN GARUT'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN TASIKMALAYA'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN CIAMIS'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN KUNINGAN'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN CIREBON'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN MAJALENGKA'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN SUMEDANG'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN INDRAMAYU'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN SUBANG'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN PURWAKARTA'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN KARAWANG'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN BEKASI'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN BANDUNG BARAT'],
            ['provinsi_id' => 2, 'kota' => 'KABUPATEN PANGANDARAN'],
            ['provinsi_id' => 2, 'kota' => 'KOTA BOGOR'],
            ['provinsi_id' => 2, 'kota' => 'KOTA SUKABUMI'],
            ['provinsi_id' => 2, 'kota' => 'KOTA BANDUNG'],
            ['provinsi_id' => 2, 'kota' => 'KOTA CIREBON'],
            ['provinsi_id' => 2, 'kota' => 'KOTA BEKASI'],
            ['provinsi_id' => 2, 'kota' => 'KOTA DEPOK'],
            ['provinsi_id' => 2, 'kota' => 'KOTA CIMAHI'],
            ['provinsi_id' => 2, 'kota' => 'KOTA TASIKMALAYA'],
            ['provinsi_id' => 2, 'kota' => 'KOTA BANJAR'],
        ];
        DB::table('kotas')->insert($kota);

    }
}
