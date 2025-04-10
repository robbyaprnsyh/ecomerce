<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->paginate(4)->withQueryString();
        return view('user.wishlist', compact('wishlists'));
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
        ]);

        $cek_wishlists = Wishlist::where('user_id', auth()->user()->id)->where('produk_id', $request->produk_id)->first();

        if (!empty($cek_wishlists)) {
            return back()->with('gagal', 'sudah di tambahkan');
        } else {
            $wishlists = new Wishlist();
            $wishlists->user_id = auth()->user()->id;
            $wishlists->produk_id = $request->produk_id;
            $wishlists->save();
            return back()->with('berhasil', 'berhasil di tambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\wishlist  $wishlist
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
     * @param  \App\Models\wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlists = Wishlist::findOrFail($id);
        $wishlists->delete();
        return back()->with('berhasil', 'Data has been deleted');
    }

    public function destroyAll()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->delete();
        return back()->with('berhasil', 'Data has been deleted');
    }
}
