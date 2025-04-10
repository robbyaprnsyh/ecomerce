<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\VoucherUser;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjangs = Keranjang::where('status', 'keranjang')->where('user_id', auth()->user()->id)->latest()->get();
        $voucher_users = VoucherUser::where('user_id', auth()->user()->id)->where('status', 'belum dipakai')->get();
        return view('user.keranjang', compact('keranjangs', 'voucher_users'));
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
        $validated = $request->validate([
            'produk_id' => 'required',
            'ukuran' => 'required',
            'jumlah' => 'required',
        ]);

        $cek_keranjangs = Keranjang::where('user_id', auth()->user()->id)->where('produk_id', $request->produk_id)->where('ukuran', $request->ukuran)->where('status', 'keranjang')->first();
        if (!empty($cek_keranjangs)) {
            $keranjangs = Keranjang::where('user_id', auth()->user()->id)->where('produk_id', $request->produk_id)->where('ukuran', $request->ukuran)->where('status', 'keranjang')->first();
            $keranjangs->jumlah += $request->jumlah;
            $diskon = (($keranjangs->produk->diskon / 100) * $keranjangs->produk->harga);
            $harga = ($keranjangs->produk->harga * $request->jumlah) - $diskon;
            $keranjangs->total_harga += $harga;
        } else {
            $keranjangs = new Keranjang();
            $keranjangs->user_id = auth()->user()->id;
            $keranjangs->produk_id = $request->produk_id;
            $keranjangs->ukuran = $request->ukuran;
            $keranjangs->jumlah = $request->jumlah;
            $diskon = (($keranjangs->produk->diskon / 100) * $keranjangs->produk->harga);
            $harga = ($keranjangs->produk->harga) - $diskon;
            $keranjangs->total_harga = ($harga * $keranjangs->jumlah);

        }
        $keranjangs->save();
        return back()->with('berhasil', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\keranjang  $keranjang
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
     * @param  \App\Models\keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keranjangs = Keranjang::findOrFail($id);
        $keranjangs->delete();
        return back()->with('berhasil', 'Data has been deleted');
    }

    public function destroyAll()
    {
        $keranjangs = Keranjang::where('user_id', auth()->user()->id)->where('status', 'keranjang')->delete();
        return back()->with('berhasil', 'Data has been deleted');
    }
}
