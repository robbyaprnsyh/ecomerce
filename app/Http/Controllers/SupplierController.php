<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\RiwayatProduk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('admin.supplier.index', compact('suppliers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = Produk::all();
        return view('admin.supplier.create', compact('produks'));

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
            'jumlah' => 'required',
        ]);

        $suppliers = new Supplier();
        $kode_suppliers = DB::table('suppliers')->select(DB::raw('MAX(RIGHT(kode_supplier,3)) as kode'));
        if ($kode_suppliers->count() > 0) {
            foreach ($kode_suppliers->get() as $kode_transaksi) {
                $x = ((int) $kode_transaksi->kode) + 1;
                $kode = sprintf('%03s', $x);
            }
        } else {
            $kode = '001';
        }
        $suppliers->kode_supplier = 'SPL-' . date('dmy') . $kode;
        $suppliers->produk_id = $request->produk_id;
        $suppliers->jumlah = $request->jumlah;
        $suppliers->save();

        $produks = Produk::findOrFail($suppliers->produk_id);
        $produks->stok += $suppliers->jumlah;
        $produks->save();

        $riwayatProduks = new RiwayatProduk();
        $riwayatProduks->produk_id = $suppliers->produk_id;
        $riwayatProduks->type = 'masuk';
        $riwayatProduks->qty = $suppliers->jumlah;
        $riwayatProduks->note = 'Barang Masuk';
        $riwayatProduks->save();

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
