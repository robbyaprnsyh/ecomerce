<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinsis = Provinsi::latest()->get();
        return view('admin.provinsi.index', compact('provinsis'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.provinsi.create');
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
            'provinsi' => 'required|unique:provinsis',
        ]);

        $provinsis = new Provinsi();
        $provinsis->provinsi = $request->provinsi;
        $provinsis->save();
        return redirect()
            ->route('provinsi.index')->with('success', 'Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provinsis = Provinsi::findOrFail($id);
        return view('admin.provinsi.edit', compact('provinsis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $provinsis = Provinsi::findOrFail($id);

        if ($request->provinsi != $provinsis->provinsi) {
            $rules['provinsi'] = 'required';
        }

        $validasiData = $request->validate($rules);

        $provinsis->provinsi = $request->provinsi;
        $provinsis->save();
        return redirect()
            ->route('provinsi.index')->with('success', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provinsis = Provinsi::findOrFail($id);
        $provinsis->delete();
        return redirect()
            ->route('provinsi.index')->with('success', 'Data has been deleted');

    }
}
