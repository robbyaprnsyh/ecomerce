<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckOngkirController extends Controller
{
    public function index()
    {
        $provinsis = Provinsi::all();
        return view('ongkir', compact('provinsis'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($id)
    {
        $kotas = Kota::where('provinsi_id', $id)->pluck('kota', 'kota_id');
        return response()->json($kotas);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check_ongkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin' => 22, // ID kota/kabupaten asal
            'destination' => $request->city_destination, // ID kota/kabupaten tujuan
            'weight' => $request->weight, // berat barang dalam gram
            'courier' => $request->courier, // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json($cost);
    }
}
