<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjang = Keranjang::where('user_id', Auth::user()->id)->get();
        return response()->json([
            'success' => true,
            'data' => $keranjang,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $validator = Validator::make($request->all(), [
            'produk_id' => 'required',
            'ukuran' => 'required',
            'jumlah' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $cek_keranjangs = Keranjang::where('user_id', Auth::user()->id)->where('produk_id', $request->produk_id)->where('ukuran', $request->ukuran)->first();

        if (!empty($cek_keranjangs)) {
            $keranjangs = Keranjang::where('user_id', Auth::user()->id)->where('produk_id', $request->produk_id)->where('ukuran', $request->ukuran)->first();
            $keranjangs->jumlah += $request->jumlah;
            $diskon = (($keranjangs->produk->diskon / 100) * $keranjangs->produk->harga);
            $harga = ($keranjangs->produk->harga * $request->jumlah) - $diskon;
            $keranjangs->total_harga += $harga;
        } else {
            $keranjangs = new Keranjang();
            $keranjangs->user_id = Auth::user()->id;
            $keranjangs->produk_id = $request->produk_id;
            $keranjangs->ukuran = $request->ukuran;
            $keranjangs->jumlah = $request->jumlah;
            $diskon = (($keranjangs->produk->diskon / 100) * $keranjangs->produk->harga);
            $keranjangs->total_harga = ($keranjangs->produk->harga * $request->jumlah) - $diskon;
        }
        $keranjangs->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Ditambahkan',
            'data' => $keranjangs,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keranjangs = Keranjang::findOrFail($id);
        $keranjangs->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil DiHapus',
        ]);
    }
}
