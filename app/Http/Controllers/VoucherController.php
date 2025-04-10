<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::latest()->get();
        return view('admin.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.voucher.create');
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
            'kode_voucher' => 'required|unique:vouchers',
            'diskon' => 'required',
            'waktu_mulai' => 'required',
            'waktu_berakhir' => 'required',
        ]);

        $vouchers = new Voucher();
        $vouchers->kode_voucher = $request->kode_voucher;
        $vouchers->diskon = $request->diskon;
        $vouchers->waktu_mulai = $request->waktu_mulai;
        $vouchers->waktu_berakhir = $request->waktu_berakhir;

        if ($vouchers->waktu_mulai > $vouchers->waktu_berakhir) {
            return back()->with('error', 'invalid date format');
        } else {
            $status = 'aktif';
        }
        $durasi = (strtotime($request->waktu_berakhir) / 60 / 60 / 24) - (strtotime($request->waktu_mulai) / 60 / 60 / 24);
        $vouchers->durasi = $durasi;
        $vouchers->status = $status;
        $vouchers->save();
        return redirect()
            ->route('voucher.index')
            ->with('success', 'Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $vouchers = Voucher::findOrFail($id);
        // return view('admin.voucher.index', compact('vouchers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // //validasi
        // $validated = $request->validate([
        //     'kode_voucher' => 'required',
        //     'harga' => 'required',
        //     // 'label' => 'required',
        //     'diskon' => 'required',
        //     'waktu_mulai' => 'required',
        //     'waktu_berakhir' => 'required',
        // ]);

        // $vouchers = Voucher::findOrFail($id);
        // $vouchers->status = $request->status;
        // $vouchers->save();
        // return redirect()
        //     ->route('voucher.index')->with('success', 'Data has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vouchers = Voucher::findOrFail($id);
        $vouchers->delete();
        return redirect()
            ->route('voucher.index')
            ->with('success', 'Data has been deleted');
    }
}
