<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\DetailTransaksi;
use App\Models\MetodePembayaran;
use App\Models\Provinsi;
use App\Models\RefundProduk;
use App\Models\ReviewProduk;
use App\Models\User;
use App\Models\VoucherUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', auth()->user()->id)->first();
        $vouchers = VoucherUser::where('user_id', $users->id)->where('status', 'belum dipakai')->get();
        $transaksis = DetailTransaksi::where('user_id', auth()->user()->id)->get();
        $metodePembayarans = MetodePembayaran::whereNot('metodePembayaran', 'GAKUNIQ WALLET')->get();
        return view('user.profil', compact('users', 'alamats', 'vouchers', 'provinsis', 'transaksis', 'metodePembayarans'));
    }

    public function akun()
    {
        $users = User::where('id', auth()->user()->id)->first();
        return view('user.profil.akun', compact('users'));
    }

    public function alamat()
    {
        $users = User::where('id', auth()->user()->id)->first();
        $alamats = Alamat::where('user_id', $users->id)->get();
        $provinsis = Provinsi::all();
        return view('user.profil.alamat', compact('users', 'alamats', 'provinsis'));
    }

    public function voucher()
    {
        $vouchers = VoucherUser::where('user_id', auth()->user()->id)->where('status', 'belum dipakai')->get();
        return view('user.profil.voucher', compact('vouchers'));
    }

    public function pesanan()
    {
        $pesanan_all = DetailTransaksi::where('user_id', auth()->user()->id)->get();
        $pesanan_proses = DetailTransaksi::where('user_id', auth()->user()->id)->where('status', 'proses')->get();
        $pesanan_selesai = DetailTransaksi::where('user_id', auth()->user()->id)->where('status', 'sukses')->get();
        $pesanan_pengajuan_refund = DetailTransaksi::where('user_id', auth()->user()->id)->whereIn('status', ['pengajuan refund', 'ditolak'])->get();
        $pesanan_dikembalikan = DetailTransaksi::where('user_id', auth()->user()->id)->where('status', 'dikembalikan')->get();
        return view('user.profil.pesanan', compact('pesanan_all', 'pesanan_proses', 'pesanan_selesai', 'pesanan_pengajuan_refund', 'pesanan_dikembalikan'));
    }

    public function konfirmasiPesanan(Request $request, $id)
    {
        $detailTransaksis = DetailTransaksi::findOrFail($id);
        $detailTransaksis->status = $request->konfirmasi;
        $detailTransaksis->save();

        return back()->with('berhasil', 'Data Konfirmed');
    }

    public function refundProduk(Request $request)
    {

        $refunds = new RefundProduk();
        $refunds->user_id = auth()->user()->id;
        $refunds->detailTransaksi_id = $request->detailTransaksi_id;
        $refunds->alasan = $request->alasan;
        $refunds->save();

        $detailTransaksis = DetailTransaksi::findOrFail($refunds->detailTransaksi_id);
        $detailTransaksis->status = 'pengajuan refund';
        $detailTransaksis->save();

        return back()->with('berhasil', 'Data berhasil ditambahkan');
    }

    public function reviewProduk(Request $request)
    {
        $reviews = new ReviewProduk();
        $reviews->user_id = auth()->user()->id;
        $reviews->detailTransaksi_id = $request->detailTransaksi_id;
        $reviews->produk_id = $reviews->detailTransaksi->keranjang->produk_id;
        $reviews->rating = $request->rating;
        $reviews->komen = $request->komen;
        $reviews->save();

        return back()->with('berhasil', 'Data berhasil ditambahkan');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //validasi
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'no_telepon' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->no_telepon = $request->no_telepon;
        $users->jenis_kelamin = $request->jenis_kelamin;
        $users->tanggal_lahir = $request->tanggal_lahir;
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/users/', $name);
            $users->profile = 'images/users/' . $name;
        }

        $users->save();
        return back()->with('berhasil', 'Data berhasil di ubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
