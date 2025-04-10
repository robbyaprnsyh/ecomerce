<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\MetodePembayaran;
use App\Models\RefundProduk;
use App\Models\User;
use Illuminate\Http\Request;

class RefundProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $refundProduks = RefundProduk::with('detailTransaksi', 'user')->where('status', 'pengajuan refund')->latest()->get();
        return view('admin.refundProduk.index', compact('refundProduks'));
    }

    public function index2()
    {
        $refundProduks = RefundProduk::with('detailTransaksi', 'user')->whereNot('status', 'pengajuan refund')->latest()->get();
        return view('admin.refundProduk.history', compact('refundProduks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detailTransaksis = DetailTransaksi::where('status', 'proses')->get();
        $users = User::where('role', 'costumer')->get();
        return view('admin.refundProduk.create', compact('detailTransaksis', 'users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'detailTransaksi_id' => 'required',
            'alasan' => 'required',
        ]);

        $refundProduks = new RefundProduk();
        $refundProduks->user_id = $request->user_id;
        $refundProduks->detailTransaksi_id = $request->detailTransaksi_id;
        $refundProduks->alasan = $request->alasan;
        $detailTransaksis = DetailTransaksi::findOrFail($refundProduks->detailTransaksi_id);
        $detailTransaksis->status = "pengajuan refund";
        $detailTransaksis->save();
        $refundProduks->save();
        return redirect()
            ->route('refundProduk.index')->with('success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RefundProduk  $refundProduk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RefundProduk  $refundProduk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $refundProduks = RefundProduk::findOrFail($id);
        return view('admin.refundProduk.edit', compact('refundProduks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RefundProduk  $refundProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required',
        ]);

        $refundProduks = RefundProduk::findOrFail($id);
        $refundProduks->status = $request->status;
        $detailTransaksis = DetailTransaksi::findOrFail($refundProduks->detailTransaksi_id);
        if ($refundProduks->status == 'disetujui') {
            $detailTransaksis->status = "dikembalikan";
            $detailTransaksis->save();
            // saldo
            $metodePembayarans = MetodePembayaran::where('id', $detailTransaksis->transaksi->metodePembayaran_id)->first();
            if ($metodePembayarans->metodePembayaran == 'GAKUNIQ WALLET') {
                $users = User::findOrFail($detailTransaksis->transaksi->user_id);

                $total_harga = DetailTransaksi::join('keranjangs', 'detail_transaksis.keranjang_id', '=', 'keranjangs.id')->
                    where('detail_transaksis.id', $detailTransaksis->id)->
                    sum("keranjangs.total_harga");

                if ($detailTransaksis->transaksi->voucher_id == '') {
                    $diskon = 0;
                } else {
                    $diskon = ($detailTransaksis->transaksi->voucher->diskon / 100) * $total_harga;
                }

                $total_bayar = $total_harga - $diskon;

                $users->saldo += $total_bayar;
                $users->save();
            }
        }

        if ($refundProduks->status == 'ditolak') {
            $detailTransaksis->status = "ditolak";
            $detailTransaksis->save();

        }
        $refundProduks->save();
        return redirect()
            ->route('refundProduk.index')->with('success', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RefundProduk  $refundProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $refundProduks = RefundProduk::findOrFail($id);
        $refundProduks->delete();
        return redirect()
            ->route('refundProduk.index')->with('success', 'Data has been deleted');
    }
}
