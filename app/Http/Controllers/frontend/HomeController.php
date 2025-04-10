<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        $new_produks = Produk::latest()->paginate(4);
        $on_diskons = Produk::latest()->where('diskon', '>', 0)->paginate(8);
        $prias = Produk::where('kategori_id', 1)->count();
        $wanitas = Produk::where('kategori_id', 2)->count();
        $anaks = Produk::where('kategori_id', 3)->count();
        $alls = Produk::count();

        return view('user.home', compact(
            'new_produks',
            'on_diskons',
            'prias',
            'wanitas',
            'anaks',
            'alls',
        ));
    }
}
