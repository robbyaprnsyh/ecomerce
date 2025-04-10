<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\ReviewProduk;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviewProduks = ReviewProduk::with('detailTransaksi', 'user')->latest()->get();
        return view('admin.reviewProduk.index', compact('reviewProduks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detailTransaksis = DetailTransaksi::all();
        $users = User::where('role', 'costumer')->get();
        return view('admin.reviewProduk.create', compact('detailTransaksis', 'users'));
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
            'user_id' => 'required',
            'detailTransaksi_id' => 'required',
            'rating' => 'required',
            'komen' => 'required',
        ]);

        $reviewProduks = new ReviewProduk();
        $reviewProduks->user_id = $request->user_id;
        $reviewProduks->detailTransaksi_id = $request->detailTransaksi_id;
        $reviewProduks->rating = $request->rating;
        $reviewProduks->produk_id = $reviewProduks->detailTransaksi->keranjang->produk_id;
        $reviewProduks->komen = $request->komen;
        $reviewProduks->save();
        return redirect()
            ->route('reviewProduk.index')->with('success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReviewProduk  $reviewProduk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReviewProduk  $reviewProduk
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
     * @param  \App\Models\ReviewProduk  $reviewProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReviewProduk  $reviewProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reviewProduks = ReviewProduk::findOrFail($id);
        $reviewProduks->delete();
        return redirect()
            ->route('reviewProduk.index')->with('success', 'Data has been deleted');

    }
}
