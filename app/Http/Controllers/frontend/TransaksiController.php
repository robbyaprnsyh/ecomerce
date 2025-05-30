<?php
namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\DetailTransaksi;
use App\Models\Keranjang;
use App\Models\MetodePembayaran;
use App\Models\Produk;
use App\Models\Provinsi;
use App\Models\RiwayatProduk;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {

        $validated = $request->validate([
            'keranjang_id' => 'required',
        ]);
        $transaksi = Transaksi::where('user_id', auth()->id())->latest()->first();

        if ($request->keranjang_id) {
            $keranjangs  = Keranjang::whereIn('id', $request->keranjang_id)->get();
            $total_harga = Keranjang::whereIn('id', $request->keranjang_id)->where('status', 'keranjang')->sum("total_harga");
            $total       = $total_harga;
        }

        $voucher_saya = '';
        if ($request->voucher_id) {
            $voucher_saya = VoucherUser::where('id', $request->voucher_id)->first();
            $vouchers     = Voucher::where('id', $voucher_saya->voucher_id)->first();
            $diskon       = $total_harga * ($vouchers->diskon / 100);
            $total_harga -= $diskon;
        }

        $voucher_users     = VoucherUser::where('user_id', auth()->user()->id)->where('status', 'belum dipakai')->get();
        $metodePembayarans = MetodePembayaran::all();
        $alamats           = Alamat::where('user_id', auth()->user()->id)->get();
        $provinsis         = Provinsi::all();
        return view('user.transaksi', compact('keranjangs', 'total', 'total_harga', 'voucher_users', 'voucher_saya', 'metodePembayarans', 'alamats', 'provinsis', 'transaksi'));
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
            'keranjang_id' => 'required',
            // 'metodePembayaran_id' => 'required',
            'alamat_id'    => 'required',
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
        $transaksis->user_id             = auth()->user()->id;
        $transaksis->alamat_id           = $request->alamat_id;
        $transaksis->voucher_id          = $request->voucher_id;
        $transaksis->metodePembayaran_id = 1;
        $transaksis->save();

        if ($transaksis->voucher_id != '') {
            $voucher_users         = VoucherUser::findOrFail($transaksis->voucher_id);
            $voucher_users->status = 'dipakai';
            $voucher_users->save();
        }

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
                    return back()->with('error', 'Stok Kurang');
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

        // // saldo
        // $metodePembayarans = MetodePembayaran::where('id', $transaksis->metodePembayaran_id)->first();
        // $users = User::findOrFail($transaksis->user_id);
        // if ($metodePembayarans->metodePembayaran == 'GAKUNIQ WALLET') {
        //     if ($users->saldo > $total_bayar) {
        //         $users->saldo -= $total_bayar;
        //     } else {
        //         $transaksis = Transaksi::where('id', $transaksis->id)->first();
        //         $transaksis->delete();
        //         return redirect()->route('transaksi.create')->with('error', 'Saldo Kurang');
        //     }
        // }

        $transaksis->findOrFail($transaksis->id);
        $transaksis->total_harga = $transaksis->total_harga ?? 0;
        $transaksis->total_harga += $total_bayar;
        $transaksis->save();

        // if ($total_harga >= 100000) {
        //     $users->point += 10000;
        // } elseif ($total_harga >= 150000) {
        //     $users->point += 10000;
        // } elseif ($total_harga >= 200000) {
        //     $users->point += 25000;
        // } elseif ($total_harga >= 250000) {
        //     $users->point += 25000;
        // }
        // $users->save();

        // return redirect('/profil/pesanan')->with('success', 'Data has been added');
        return redirect()->route('pembayaran', $transaksis->id)->with('success', 'Checkout berhasil, Lanjutkan Pembayaran!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function pembayaran(Transaksi $transaksi)
    {
        // Ambil semua detail transaksi termasuk produk yang dipesan
        $detailTransaksis = DetailTransaksi::with('keranjang.produk')->where('transaksi_id', $transaksi->id)->get();

        // Ambil informasi alamat pengiriman
        $alamat = Alamat::find($transaksi->alamat_id);

        // Ambil metode pembayaran
        $metodePembayaran = MetodePembayaran::find($transaksi->metodePembayaran_id);

        // Cek apakah ada diskon
        $diskon      = $transaksi->voucher_id ? $transaksi->voucher->diskon : 0;
        $total_harga = $transaksi->total_harga;

        return view('user.pembayaran', [
            'transaksi'           => $transaksi,
            'detailTransaksis'    => $detailTransaksis,
            'alamat'              => $alamat,
            'metodePembayaran'    => $metodePembayaran,
            'diskon'              => $diskon,
            'total_harga'         => $total_harga,
            'midtrans_client_key' => config('midtrans.client_key'), 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaksi $transaksi)
    {
        //
    }
}
