<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UkuranProduk;
use Illuminate\Http\Request;

class UkuranProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ukuranProduks = UkuranProduk::latest()->get();
        return view('admin.ukuranProduk.index', compact('ukuranProduks'));
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
        $ukuranProduks = UkuranProduk::where('produk_id', $request->produk_id)->delete();

        foreach ($request->ukuran as $ukuran) {
            $ukuranProduks = new UkuranProduk();
            $ukuranProduks->produk_id = $request->produk_id;
            $ukuranProduks->ukuran_id = $ukuran;
            $ukuranProduks->save();
        }
        return back()->with('success', 'Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UkuranProduk  $ukuranProduk
     * @return \Illuminate\Http\Response
     */
    public function show(UkuranProduk $ukuranProduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UkuranProduk  $ukuranProduk
     * @return \Illuminate\Http\Response
     */
    public function edit(UkuranProduk $ukuranProduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UkuranProduk  $ukuranProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UkuranProduk $ukuranProduk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UkuranProduk  $ukuranProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ukuranProduks = UkuranProduk::findOrFail($id);
        $ukuranProduks->delete();
        return back()->with('success', 'Data has been deleted');

    }
}
