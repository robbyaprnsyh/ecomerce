<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\VoucherUser;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function voucher()
    {
        $vouchers = Voucher::all();
        return view('user.voucher', compact('vouchers'));
    }

    public function klaim(Request $request)
    {
        $cek_vouchers = VoucherUser::where('user_id', auth()->user()->id)->where('voucher_id', $request->voucher_id)->first();

        if (!empty($cek_vouchers)) {
            return back()->with('gagal', 'voucher sudah di klaim');
        } else {
            $vouchers = new VoucherUser();
            $vouchers->user_id = auth()->user()->id;
            $vouchers->voucher_id = $request->voucher_id;
            $vouchers->save();

            return back()->with('berhasil', 'voucher berhasil di klaim');
        }
    }
}
