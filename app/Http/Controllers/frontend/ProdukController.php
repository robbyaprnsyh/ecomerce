<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Image;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\ReviewProduk;
use App\Models\Ukuran;
use App\Models\UkuranProduk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function produk(Request $request)
    {
        $kategoris = Kategori::all();
        $ukurans = Ukuran::all();
        $produks_diskon = Produk::where('diskon', '>', 0)->count();
        $produks = Produk::latest()->paginate(12);
        if ($request->kategori) {
            $produks = Produk::where('kategori_id', $request->kategori)->latest()->paginate(12)->withQueryString();
        }

        if ($request->subKategori) {
            $produks = Produk::where('sub_kategori_id', $request->subKategori)->latest()->paginate(12)->withQueryString();
        }

        if ($request->min || $request->max) {
            $produks = Produk::whereBetween('harga', [$request->min, $request->max])->paginate(12)->withQueryString();
        }

        $keyword = $request->keyword;
        if ($keyword) {
            $produks = Produk::where('nama_produk', 'LIKE', '%' . $keyword . '%')->paginate(12)->withQueryString();
        }

        if ($request->diskon) {
            $produks = Produk::where('diskon', '>', 0)->paginate(12)->withQueryString();
        }

        // if ($request->ukuran) {
        //     $produks = UkuranProduk::where('ukuran_id', 1)
        //         ->get();

        //     dd($produks);
        // }

        return view('user.produk', compact('produks', 'kategoris', 'keyword', 'ukurans', 'produks_diskon'));
    }

    public function detailProduk($id)
    {
        $produks = Produk::findOrFail($id);
        $produks_terjual = DetailTransaksi::join('keranjangs', 'detail_transaksis.keranjang_id', '=', 'keranjangs.id')->
            where('keranjangs.produk_id', $id)->where('detail_transaksis.status', 'sukses')->count();
        $jumlah_rating = $produks->reviewProduk->count();
        $images = Image::where('produk_id', $produks->id)->get();
        $produk_lainnya = Produk::where('sub_kategori_id', $produks->sub_kategori_id)->paginate(4)->withQueryString();
        $ukuranProduks = UkuranProduk::where('produk_id', $id)->get();
        $allReview_produks = ReviewProduk::where('produk_id', $produks->id)->paginate(5)->withQueryString();
        $review_produks5 = ReviewProduk::where('produk_id', $produks->id)->where('rating', 5)->paginate(5)->withQueryString();
        $review_produks4 = ReviewProduk::where('produk_id', $produks->id)->where('rating', 4)->paginate(5)->withQueryString();
        $review_produks3 = ReviewProduk::where('produk_id', $produks->id)->where('rating', 3)->paginate(5)->withQueryString();
        $review_produks2 = ReviewProduk::where('produk_id', $produks->id)->where('rating', 2)->paginate(5)->withQueryString();
        $review_produks1 = ReviewProduk::where('produk_id', $produks->id)->where('rating', 1)->paginate(5)->withQueryString();

        return view('user.detailProduk', compact(
            'produks',
            'produk_lainnya',
            'images',
            'allReview_produks',
            'ukuranProduks',
            'jumlah_rating',
            'review_produks5',
            'review_produks4',
            'review_produks3',
            'review_produks2',
            'review_produks1',
            'produks_terjual'));

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
        //
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
        //
    }
}
