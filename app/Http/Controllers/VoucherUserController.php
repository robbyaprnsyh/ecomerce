<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherUser;
use Illuminate\Http\Request;

class VoucherUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voucherUsers = VoucherUser::with('user', 'voucher')->latest()->get();
        return view('admin.voucherUser.index', compact('voucherUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vouchers = Voucher::where('status', 'aktif')->get();
        $users = User::where('role', 'costumer')->get();
        return view('admin.voucherUser.create', compact('vouchers', 'users'));

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
            'voucher_id' => 'required',
        ]);

        $cek_vouchers = VoucherUser::where('user_id', $request->user_id)->where('voucher_id', $request->voucher_id)->first();
        if (!empty($cek_vouchers)) {
            return back()->with('error', 'data sudah ada');
        } else {
            $voucherUsers = new VoucherUser();
            $voucherUsers->user_id = $request->user_id;
            $voucherUsers->voucher_id = $request->voucher_id;
            $voucherUsers->save();
        }
        return redirect()
            ->route('voucherUser.index')->with('success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoucherUser  $voucherUser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoucherUser  $voucherUser
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
     * @param  \App\Models\VoucherUser  $voucherUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoucherUser  $voucherUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voucherUsers = VoucherUser::findOrFail($id);
        $voucherUsers->delete();
        return redirect()
            ->route('voucherUser.index')->with('success', 'Data has been deleted');

    }
}
