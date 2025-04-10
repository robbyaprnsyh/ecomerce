<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use App\Models\User;
use App\Models\VoucherUser;
use Illuminate\Http\Request;

class VoucherUserController extends Controller
{
    public function index()
    {
        $voucherUsers = VoucherUser::where('user_id', auth()->user()->id)->latest()->get();
        return view('user.voucherUser', compact('voucherUsers'));
    }

    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'voucher_id' => 'required',
            'metodePembayaran_id' => 'required',
        ]);

        $voucherUsers = new VoucherUser();
        $voucherUsers->user_id = auth()->user()->id;
        $voucherUsers->voucher_id = $request->voucher_id;
        $voucherUsers->metodePembayaran_id = $request->metodePembayaran_id;

        // saldo
        $users = User::findOrFail($voucherUsers->user_id);
        $metodePembayarans = MetodePembayaran::where('id', $voucherUsers->metodePembayaran_id)->first();
        if ($metodePembayarans->metodePembayaran == 'GAKUNIQ WALLET') {
            if ($users->saldo < $voucherUsers->voucher->harga) {
                return back()->with('error', 'Saldo Kurang');
            } else {
                $users->saldo -= $voucherUsers->voucher->harga;
            }
            $users->save();
        }

        $voucherUsers->save();
        return redirect()
            ->route('voucherSaya.index')->with('berhasil', 'Data has been added');
    }
}
