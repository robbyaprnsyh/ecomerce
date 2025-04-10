<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history()
    {
        $historis = DetailTransaksi::where('user_id', auth()->user()->id)->whereIn('status', ['sukses', 'ditolak'])->latest()->get();
        return view('user.history', compact('historis'));
    }

    public function proses()
    {
        $prosess = DetailTransaksi::where('user_id', auth()->user()->id)->where('status', 'proses')->latest()->get();
        return view('user.proses', compact('prosess'));
    }

    public function refund()
    {
        $refunds = DetailTransaksi::where('user_id', auth()->user()->id)->whereIn('status', ['pengajuan refund', 'dikembalikan'])->latest()->get();
        return view('user.refund', compact('refunds'));
    }

    public function konfirmasi(Request $request, $id)
    {

        $konfirmasis = DetailTransaksi::findOrFail($id);
        if ($request->konfirmasi == 'selesai') {
            $konfirm = "sukses";
        } else {
            $konfirm = "pengajuan refund";
        }
        $konfirmasis->status = $konfirm;
        $konfirmasis->save();

        return back()->with('berhasil', 'Data Konfirmed');
    }
}
