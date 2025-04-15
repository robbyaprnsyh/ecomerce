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
use Midtrans\Snap;

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
        // Validasi input
        $validated = $request->validate([
            'user_id'             => 'required',
            'metodePembayaran_id' => 'required',
            'alamat_id'           => 'required',
        ]);

        // Membuat transaksi baru
        $transaksis      = new Transaksi();
        $kode_transaksis = DB::table('transaksis')->select(DB::raw('MAX(RIGHT(kode_transaksi,3)) as kode'));
        $kode            = $kode_transaksis->count() > 0 ? sprintf('%03s', ((int) $kode_transaksis->first()->kode) + 1) : '001';

        // Menyimpan data transaksi
        $transaksis->kode_transaksi      = 'SKO-' . date('dmy') . $kode;
        $transaksis->user_id             = $request->user_id;
        $transaksis->alamat_id           = $request->alamat_id;
        $transaksis->voucher_id          = $request->voucher_id ?? null; // pastikan voucher_id tidak null
        $transaksis->metodePembayaran_id = $request->metodePembayaran_id;
        $transaksis->save();

        // Proses detail transaksi
        foreach ($request->keranjang_id as $keranjang) {
            $detailTransaksi               = new DetailTransaksi();
            $detailTransaksi->transaksi_id = $transaksis->id;
            $detailTransaksi->user_id      = $transaksis->user_id;
            $detailTransaksi->keranjang_id = $keranjang;
            $detailTransaksi->save();

            $keranjangs = Keranjang::where('id', $detailTransaksi->keranjang_id)->get();
            foreach ($keranjangs as $keranjangItem) {
                $produk = Produk::where('id', $keranjangItem->produk_id)->first();
                if ($produk->stok < $keranjangItem->jumlah) {
                    // Jika stok kurang, transaksi dibatalkan
                    $transaksis->delete();
                    return redirect()->route('transaksi.create')->with('error', 'Stok Kurang');
                }
                $keranjangItem->status = 'checkout';
                $keranjangItem->save();
                $produk->stok -= $keranjangItem->jumlah;
                $produk->save();

                // Catat riwayat produk yang terjual
                $riwayat            = new RiwayatProduk();
                $riwayat->produk_id = $produk->id;
                $riwayat->type      = 'keluar';
                $riwayat->qty       = $keranjangItem->jumlah;
                $riwayat->note      = 'Barang terjual';
                $riwayat->save();
            }
        }

        // Hitung total harga
        $total_harga = DetailTransaksi::join('keranjangs', 'detail_transaksis.keranjang_id', '=', 'keranjangs.id')
            ->where('detail_transaksis.transaksi_id', $transaksis->id)
            ->sum("keranjangs.total_harga");

        // Hitung diskon jika voucher ada
        $diskon      = $transaksis->voucher_id ? ($transaksis->voucher->diskon / 100) * $total_harga : 0;
        $total_bayar = $total_harga - $diskon;

        // Cek metode pembayaran dan pengguna
        $metode = MetodePembayaran::find($transaksis->metodePembayaran_id);
        $user   = User::findOrFail($transaksis->user_id);

        // Proses pembayaran dengan SUKO WALLET
        if ($metode->metodePembayaran == 'SUKO WALLET') {
            if ($user->saldo >= $total_bayar) {
                $user->saldo -= $total_bayar;
            } else {
                // Jika saldo tidak cukup, batalkan transaksi
                $transaksis->delete();
                return redirect()->route('transaksi.create')->with('error', 'Saldo Kurang');
            }
        }

        // Simpan total harga transaksi
        $transaksis->total_harga = $total_bayar;
        $transaksis->save();

        // Update poin pengguna
        if ($total_harga >= 250000) {
            $user->point += 25000;
        } elseif ($total_harga >= 200000) {
            $user->point += 25000;
        } elseif ($total_harga >= 150000) {
            $user->point += 10000;
        } elseif ($total_harga >= 100000) {
            $user->point += 10000;
        }
        $user->save();

        // Proses pembayaran dengan Midtrans (jika bukan SUKO WALLET)
        if ($metode->metodePembayaran != 'SUKO WALLET') {
            // Konfigurasi Midtrans
            Config::$serverKey    = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized  = config('midtrans.sanitized');
            Config::$is3ds        = config('midtrans.3ds');

            // Persiapkan parameter transaksi
            $params = [
                'transaction_details' => [
                    'order_id'     => $transaksis->kode_transaksi,
                    'gross_amount' => $total_bayar,
                ],
                'customer_details'    => [
                    'first_name' => $user->name,
                    'email'      => $user->email,
                    'phone'      => $user->telepon ?? '081234567890',
                ],
                'enabled_payments'    => ['gopay', 'bank_transfer', 'bca_va', 'permata_va'],
            ];

            // Mendapatkan snap token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Simpan snap_token di transaksi
            $transaksis->snap_token = $snapToken;
            $transaksis->save();

            // Arahkan ke halaman pembayaran
            return redirect()->route('transaksi.payment', ['id' => $transaksis->id]);
        }

        // Jika pembayaran menggunakan SUKO WALLET atau pembayaran selesai
        // return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diproses.');
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
