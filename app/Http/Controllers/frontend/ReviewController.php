<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ReviewProduk;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review($id)
    {
        $review_produks = ReviewProduk::where('produk_id', $id)->latest()->paginate(5);
        return view('user.review', compact('review_produks'));
    }

    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'detailTransaksi_id' => 'required',
            'rating' => 'required',
            'komen' => 'required',
        ]);

        $reviewProduks = new ReviewProduk();
        $reviewProduks->user_id = auth()->user()->id;
        $reviewProduks->detailTransaksi_id = $request->detailTransaksi_id;
        $reviewProduks->rating = $request->rating;
        $reviewProduks->produk_id = $reviewProduks->detailTransaksi->keranjang->produk_id;
        $reviewProduks->komen = $request->komen;
        $reviewProduks->save();
        return back()->with('success', 'Data has been added');
    }
}
