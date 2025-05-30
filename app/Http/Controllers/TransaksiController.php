<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\DetailTransaksi;
use App\Models\Keranjang;
use App\Models\MetodePembayaran;
use App\Models\Produk;
use App\Models\RiwayatProduk;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::with('metodePembayaran', 'voucher', 'user', 'alamat')->latest()->get();

        return view('admin.transaksi.index', compact('transaksis'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users             = User::where('role', 'costumer')->get();
        $keranjangs        = Keranjang::where('status', 'keranjang')->get();
        $voucherUsers      = VoucherUser::all();
        $vouchers          = Voucher::where('status', 'aktif')->where('label', 'gratis')->get();
        $metodePembayarans = MetodePembayaran::all();
        $alamats           = Alamat::all();
        return view('admin.transaksi.create', compact('keranjangs', 'vouchers', 'voucherUsers', 'users', 'metodePembayarans', 'alamats'));

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
            'user_id'             => 'required',
            'metodePembayaran_id' => 'required',
            'alamat_id'           => 'required',
        ]);

        $transaksis      = new Transaksi();
        $kode_transaksis = DB::table('transaksis')->select(DB::raw('MAX(RIGHT(kode_transaksi,3)) as kode'));
        if ($kode_transaksis->count() > 0) {
            foreach ($kode_transaksis->get() as $kode_transaksi) {
                $x    = ((int) $kode_transaksi->kode) + 1;
                $kode = sprintf('%03s', $x);
            }
        } else {
            $kode = '001';
        }
        $transaksis->kode_transaksi      = 'SKO-' . date('dmy') . $kode;
        $transaksis->user_id             = $request->user_id;
        $transaksis->alamat_id           = $request->alamat_id;
        $transaksis->voucher_id          = $request->voucher_id;
        $transaksis->metodePembayaran_id = $request->metodePembayaran_id;
        $transaksis->save();

        foreach ($request->keranjang_id as $keranjang) {
            $detailTransaksi               = new DetailTransaksi();
            $detailTransaksi->transaksi_id = $transaksis->id;
            $detailTransaksi->user_id      = $transaksis->user_id;
            $detailTransaksi->keranjang_id = $keranjang;
            $detailTransaksi->save();

            $keranjangs = Keranjang::where('id', $detailTransaksi->keranjang_id)->get();
            foreach ($keranjangs as $keranjang) {
                $produks = Produk::where('id', $keranjang->produk_id)->first();
                if ($produks->stok < $keranjang->jumlah) {
                    $transaksis = Transaksi::where('id', $transaksis->id)->first();
                    $transaksis->delete();
                    return redirect()->route('transaksi.create')->with('error', 'Stok Kurang');
                } else {
                    $keranjang->status = 'checkout';
                    $keranjang->save();
                    $produks->stok -= $keranjang->jumlah;
                }
                $produks->save();

                $riwayatProduks            = new RiwayatProduk();
                $riwayatProduks->produk_id = $produks->id;
                $riwayatProduks->type      = 'keluar';
                $riwayatProduks->qty       = $keranjang->jumlah;
                $riwayatProduks->note      = 'Barang terjual';
                $riwayatProduks->save();

            }
        }

        $total_harga = DetailTransaksi::join('keranjangs', 'detail_transaksis.keranjang_id', '=', 'keranjangs.id')->
            where('detail_transaksis.transaksi_id', $transaksis->id)->
            sum("keranjangs.total_harga");

        if ($transaksis->voucher_id == '') {
            $diskon = 0;
        } else {
            $diskon = ($transaksis->voucher->diskon / 100) * $total_harga;
        }
        $total_bayar = $total_harga - $diskon;

        // saldo
        $metodePembayarans = MetodePembayaran::where('id', $transaksis->metodePembayaran_id)->first();
        $users             = User::findOrFail($transaksis->user_id);
        if ($metodePembayarans->metodePembayaran == 'SUKO WALLET') {
            if ($users->saldo > $total_bayar) {
                $users->saldo -= $total_bayar;
            } else {
                $transaksis = Transaksi::where('id', $transaksis->id)->first();
                $transaksis->delete();
                return redirect()->route('transaksi.create')->with('error', 'Saldo Kurang');
            }
        }

        $transaksis->findOrFail($transaksis->id);
        $transaksis->total_harga += $total_bayar;
        $transaksis->save();

        if ($total_harga >= 100000) {
            $users->point += 10000;
        } elseif ($total_harga >= 150000) {
            $users->point += 10000;
        } elseif ($total_harga >= 200000) {
            $users->point += 25000;
        } elseif ($total_harga >= 250000) {
            $users->point += 25000;
        }
        $users->save();

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksis       = Transaksi::findOrFail($id);
        $detailTransaksis = DetailTransaksi::where('transaksi_id', $id)->get();
        $total_harga      = DetailTransaksi::join('keranjangs', 'detail_transaksis.keranjang_id', '=', 'keranjangs.id')->
            where('detail_transaksis.transaksi_id', $id)->
            sum("keranjangs.total_harga");
        if ($transaksis->voucher_id == '') {
            $diskon = 0;
        } else {
            $diskon = ($transaksis->voucher->diskon / 100) * $total_harga;
        }
        $total_bayar = $total_harga - $diskon;
        $alamats     = Alamat::findOrFail($transaksis->alamat_id);
        return view('admin.transaksi.show', compact('transaksis', 'detailTransaksis', 'total_harga', 'total_bayar', 'diskon', 'alamats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
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
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksis = Transaksi::findOrFail($id);
        $transaksis->delete();
        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Data has been deleted');

    }
}
