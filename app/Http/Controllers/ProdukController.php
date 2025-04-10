<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\SubKategori;
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
    public function index()
    {
        $produks = Produk::with('kategori', 'subKategori')->latest()->get();
        return view('admin.produk.index', compact('produks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $ukurans = Ukuran::all();
        return view('admin.produk.create', compact('kategoris', 'ukurans'));
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
            'kategori_id' => 'required',
            'sub_kategori_id' => 'required',
            'nama_produk' => 'required',
            'hpp' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'gambar_produk' => 'required',
            'ukuran' => 'required',
        ]);

        $produks = new Produk();
        $produks->kategori_id = $request->kategori_id;
        $produks->sub_kategori_id = $request->sub_kategori_id;
        $produks->nama_produk = $request->nama_produk;
        $produks->hpp = $request->hpp;
        $produks->harga = $request->harga;
        $produks->stok = $request->stok;
        $produks->diskon = $request->diskon;
        $produks->deskripsi = $request->deskripsi;
        $produks->save();

        if ($request->hasfile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $image) {
                $name = rand(1000, 9999) . $image->getClientOriginalName();
                $image->move('images/gambar_produk/', $name);
                $images = new Image();
                $images->produk_id = $produks->id;
                $images->gambar_produk = 'images/gambar_produk/' . $name;
                $images->save();
            }
        }

        foreach ($request->ukuran as $ukuran) {
            $ukuranProduks = new UkuranProduk();
            $ukuranProduks->produk_id = $produks->id;
            $ukuranProduks->ukuran_id = $ukuran;
            $ukuranProduks->save();
        }

        return redirect()
            ->route('produk.index')->with('success', 'Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produks = Produk::findOrFail($id);
        $images = Image::where('produk_id', $id)->get();
        return view('admin.produk.show', compact('produks', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategoris = Kategori::all();
        $produks = Produk::findOrFail($id);
        $subKategoris = SubKategori::where('kategori_id', $produks->kategori_id)->get();
        $images = Image::where('produk_id', $id)->get();
        $ukurans = Ukuran::get(['id', 'ukuran']);
        return view('admin.produk.edit', compact('kategoris', 'produks', 'subKategoris', 'images', 'ukurans'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validasi
        $validated = $request->validate([
            'kategori_id' => 'required',
            'sub_kategori_id' => 'required',
            'nama_produk' => 'required',
            'hpp' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
        ]);

        $produks = Produk::findOrFail($id);
        $produks->kategori_id = $produks->kategori_id;
        $produks->sub_kategori_id = $request->sub_kategori_id;
        $produks->nama_produk = $request->nama_produk;
        $produks->hpp = $request->hpp;
        $produks->harga = $request->harga;
        $produks->stok = $request->stok;
        $produks->diskon = $request->diskon;
        $produks->deskripsi = $request->deskripsi;
        $produks->save();

        $ukuranProduks = UkuranProduk::where('produk_id', $produks->id)->delete();
        foreach ($request->ukuran as $ukuran) {
            $ukuranProduks = new UkuranProduk();
            $ukuranProduks->produk_id = $produks->id;
            $ukuranProduks->ukuran_id = $ukuran;
            $ukuranProduks->save();
        }
        return redirect()
            ->route('produk.index')->with('success', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produks = Produk::findOrFail($id);
        $images = Image::where('produk_id', $id)->get();
        foreach ($images as $image) {
            $image->deleteImage();
            $image->delete();
        }
        $produks->delete();
        return redirect()
            ->route('produk.index')->with('success', 'Data has been deleted');
    }
}
