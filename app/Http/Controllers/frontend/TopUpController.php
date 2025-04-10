<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\TopUp;
use App\Models\User;
use Illuminate\Http\Request;

class TopUpController extends Controller
{
    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'jumlah_saldo' => 'required',
            'metodePembayaran_id' => 'required',
        ]);

        $topUps = new TopUp();
        $topUps->user_id = auth()->user()->id;
        $topUps->jumlah_saldo = $request->jumlah_saldo;
        $topUps->metodePembayaran_id = $request->metodePembayaran_id;
        $topUps->save();

        $users = User::findOrFail($topUps->user_id);
        $users->saldo += $topUps->jumlah_saldo;
        $users->save();
        return back()->with('berhasil', 'Data has been added');
    }
}
