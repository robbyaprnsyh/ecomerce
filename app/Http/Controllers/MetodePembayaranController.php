<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metodePembayarans = MetodePembayaran::latest()->get();
        return view('admin.metodePembayaran.index', compact('metodePembayarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.metodePembayaran.create');
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
            'metodePembayaran' => 'required|unique:metode_pembayarans',
        ]);

        $metodePembayarans = new MetodePembayaran();
        $metodePembayarans->metodePembayaran = $request->metodePembayaran;
        $metodePembayarans->save();
        return redirect()
            ->route('metodePembayaran.index')->with('success', 'Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MetodePembayaran  $metodePembayaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MetodePembayaran  $metodePembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metodePembayarans = MetodePembayaran::findOrFail($id);
        return view('admin.metodePembayaran.edit', compact('metodePembayarans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MetodePembayaran  $metodePembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $metodePembayarans = MetodePembayaran::findOrFail($id);

        if ($request->metodePembayaran != $metodePembayarans->metodePembayaran) {
            $rules['metodePembayaran'] = 'required|unique:metode_pembayarans';
        } else {
            $rules['metodePembayaran'] = 'required';
        }
        $validasiData = $request->validate($rules);

        $metodePembayarans->metodePembayaran = $request->metodePembayaran;
        $metodePembayarans->save();
        return redirect()
            ->route('metodePembayaran.index')->with('success', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MetodePembayaran  $metodePembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $metodePembayarans = MetodePembayaran::findOrFail($id);
        $metodePembayarans->delete();
        return redirect()
            ->route('metodePembayaran.index')->with('success', 'Data has been deleted');

    }
}
