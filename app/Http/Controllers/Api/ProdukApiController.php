<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\SubKategori;
use App\Models\Ukuran;
use App\Models\UkuranProduk;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProdukApiController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori', 'subKategori', 'image')->latest()->get();
        return response()->json($produks);
    }

    public function store(Request $request)
    {
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

        $produks = Produk::create($validated);

        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $image) {
                $name = rand(1000, 9999) . $image->getClientOriginalName();
                $image->move('images/gambar_produk/', $name);
                Image::create(['produk_id' => $produks->id, 'gambar_produk' => 'images/gambar_produk/' . $name]);
            }
        }

        foreach ($request->ukuran as $ukuran) {
            UkuranProduk::create(['produk_id' => $produks->id, 'ukuran_id' => $ukuran]);
        }

        return response()->json(['message' => 'Data has been added', 'data' => $produks], 201);
    }

    public function show($id)
    {
        $produk = Produk::with('image', 'ukuranProduk')->findOrFail($id);
        return response()->json($produk);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kategori_id' => 'required',
            'sub_kategori_id' => 'required',
            'nama_produk' => 'required',
            'hpp' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($validated);

        UkuranProduk::where('produk_id', $produk->id)->delete();
        foreach ($request->ukuran as $ukuran) {
            UkuranProduk::create(['produk_id' => $produk->id, 'ukuran_id' => $ukuran]);
        }

        return response()->json(['message' => 'Data has been updated', 'data' => $produk]);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        Image::where('produk_id', $id)->delete();
        UkuranProduk::where('produk_id', $id)->delete();
        $produk->delete();

        return response()->json(['message' => 'Data has been deleted']);
    }
}
