<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kotas = Kota::with('provinsi')->latest()->get();
        return view('admin.kota.index', compact('kotas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsis = Provinsi::all();
        return view('admin.kota.create', compact('provinsis'));
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
            'provinsi_id' => 'required',
            'kota' => 'required|unique:kotas',
        ]);

        $kotas = new Kota();
        $kotas->provinsi_id = $request->provinsi_id;
        $kotas->kota = $request->kota;
        $kotas->save();
        return redirect()
            ->route('kota.index')->with('success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kotas = Kota::findOrFail($id);
        $provinsis = Provinsi::all();
        return view('admin.kota.edit', compact('provinsis', 'kotas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kotas = Kota::findOrFail($id);
        $rules['provinsi_id'] = 'required';
        if ($request->provinsi != $kotas->kotas) {
            $rules['kota'] = 'required';
        }

        $validasiData = $request->validate($rules);
        $kotas->provinsi_id = $request->provinsi_id;
        $kotas->kota = $request->kota;
        $kotas->save();
        return redirect()
            ->route('kota.index')->with('success', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kotas = Kota::findOrFail($id);
        $kotas->delete();
        return redirect()
            ->route('kota.index')->with('success', 'Data has been deleted');
    }

    public function getKota($id)
    {
        $kotas = Kota::where('provinsi_id', $id)->get();
        return response()->json($kotas);
    }
}
