<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecamatans = Kecamatan::with('provinsi', 'kota')->latest()->get();
        return view('admin.kecamatan.index', compact('kecamatans'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsis = Provinsi::all();
        return view('admin.kecamatan.create', compact('provinsis'));

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
            'kota_id' => 'required',
            'kecamatan' => 'required|unique:kecamatans',
        ]);

        $kecamatans = new Kecamatan();
        $kecamatans->provinsi_id = $request->provinsi_id;
        $kecamatans->kota_id = $request->kota_id;
        $kecamatans->kecamatan = $request->kecamatan;
        $kecamatans->save();
        return redirect()
            ->route('kecamatan.index')->with('success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kecamatans = Kecamatan::findOrFail($id);
        $provinsis = Provinsi::all();
        $kotas = Kota::where('provinsi_id', $kecamatans->provinsi_id)->get();
        return view('admin.kecamatan.edit', compact('provinsis', 'kecamatans', 'kotas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kecamatans = Kecamatan::findOrFail($id);
        $rules['provinsi_id'] = 'required';
        $rules['kota_id'] = 'required';
        if ($request->kecamatan != $kecamatans->kecamatan) {
            $rules['kecamatan'] = 'required';
        }

        $kecamatans->provinsi_id = $request->provinsi_id;
        $kecamatans->kota_id = $request->kota_id;
        $kecamatans->kecamatan = $request->kecamatan;
        $kecamatans->save();
        return redirect()
            ->route('kecamatan.index')->with('success', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kecamatans = Kecamatan::findOrFail($id);
        $kecamatans->delete();
        return redirect()
            ->route('kecamatan.index')->with('success', 'Data has been deleted');
    }

    public function getKecamatan($id)
    {
        $kecamatans = Kecamatan::where('kota_id', $id)->get();
        return response()->json($kecamatans);
    }
}
