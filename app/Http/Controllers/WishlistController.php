<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\User;
use App\Models\Wishlist;
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
        $wishlists = Wishlist::with('produk', 'user')->latest()->get();
        return view('admin.wishlist.index', compact('wishlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = Produk::all();
        $users = User::where('role', 'costumer')->get();
        return view('admin.wishlist.create', compact('produks', 'users'));

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
            'produk_id' => 'required',
        ]);

        $cek_wishlists = Wishlist::where('user_id', $request->user_id)->where('produk_id', $request->produk_id)->first();

        if (!empty($cek_wishlists)) {
            return back()->with('error', 'Data telah di tambahkan');
        } else {
            $wishlists = new Wishlist();
            $wishlists->user_id = $request->user_id;
            $wishlists->produk_id = $request->produk_id;
            $wishlists->save();
            return redirect()
                ->route('wishlistAdmin.index')->with('success', 'Data has been added');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
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
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlists = Wishlist::findOrFail($id);
        $wishlists->delete();
        return redirect()
            ->route('wishlistAdmin.index')->with('success', 'Data has been deleted');

    }
}
