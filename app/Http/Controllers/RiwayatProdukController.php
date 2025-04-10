<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\RiwayatProduk;
use Illuminate\Http\Request;

class RiwayatProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riwayatProduks = RiwayatProduk::with('produk')->latest()->get();
        return view('admin.riwayatProduk.index', compact('riwayatProduks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = Produk::all();
        return view('admin.produk.index', compact('produks'));
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
        $validated = $request->validate([
            'produk_id' => 'required',
            'type' => 'required',
            'qty' => 'required',
            'note' => 'required',
        ]);

        $riwayatProduks = new RiwayatProduk();
        $riwayatProduks->produk_id = $request->produk_id;
        $riwayatProduks->type = $request->type;
        $riwayatProduks->qty = $request->qty;
        $riwayatProduks->note = $request->note;
        $riwayatProduks->save();

        $produks = Produk::findOrFail($riwayatProduks->produk_id);
        if ($riwayatProduks->type == 'masuk') {
            $produks->stok += $riwayatProduks->qty;
        } elseif ($riwayatProduks->type == 'keluar') {
            if ($produks->stok < $riwayatProduks->qty) {
                return redirect()
                    ->route('produk.index')->with('error', 'Stok Kurang');
            } else {
                $produks->stok -= $riwayatProduks->qty;
            }
        }

        $produks->save();
        return redirect()
            ->route('produk.index')->with('success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiwayatProduk  $riwayatProduk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatProduk  $riwayatProduk
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
     * @param  \App\Models\RiwayatProduk  $riwayatProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatProduk  $riwayatProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $riwayatProduks = RiwayatProduk::findOrFail($id);
        $riwayatProduks->delete();
        return redirect()
            ->route('riwayatProduk.index')->with('success', 'Data has been deleted');

    }
}
