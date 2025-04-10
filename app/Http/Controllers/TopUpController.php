<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use App\Models\TopUp;
use App\Models\User;
use Illuminate\Http\Request;

class TopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topUps = TopUp::with('user', 'metodePembayaran')->latest()->get();
        return view('admin.topUp.index', compact('topUps'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'costumer')->get();
        $metodePembayarans = MetodePembayaran::whereNot('metodePembayaran', 'GAKUNIQ WALLET')->get();
        return view('admin.topUp.create', compact('users', 'metodePembayarans'));

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
            'user_id' => 'required',
            'jumlah_saldo' => 'required',
            'metodePembayaran_id' => 'required',
        ]);

        $topUps = new TopUp();
        $topUps->user_id = $request->user_id;
        $topUps->jumlah_saldo = $request->jumlah_saldo;
        $topUps->metodePembayaran_id = $request->metodePembayaran_id;
        $topUps->save();

        $users = User::findOrFail($topUps->user_id);
        $users->saldo += $topUps->jumlah_saldo;
        $users->save();
        return redirect()
            ->route('topUp.index')
            ->with('success', 'Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
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
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topUps = TopUp::findOrFail($id);
        $topUps->delete();
        return redirect()
            ->route('topUp.index')
            ->with('success', 'Data has been deleted');

    }
}
