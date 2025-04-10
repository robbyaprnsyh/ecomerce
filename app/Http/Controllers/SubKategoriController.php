<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;

class SubKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subKategoris = subKategori::with('kategori')->latest()->get();
        return view('admin.subKategori.index', compact('subKategoris'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.subKategori.create', compact('kategoris'));
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
            'kategori_id' => 'required',
            'name' => 'required',
        ]);

        $subKategoris = new subKategori();
        $subKategoris->kategori_id = $request->kategori_id;
        $subKategoris->name = $request->name;
        $subKategoris->save();
        return redirect()
            ->route('subKategori.index')->with('success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubKategori  $subKategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubKategori  $subKategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subKategoris = subKategori::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.subKategori.edit', compact('kategoris', 'subKategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubKategori  $subKategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validasi
        $validated = $request->validate([
            'kategori_id' => 'required',
            'name' => 'required',
        ]);

        $subKategoris = subKategori::findOrFail($id);
        $subKategoris->kategori_id = $request->kategori_id;
        $subKategoris->name = $request->name;
        $subKategoris->save();
        return redirect()
            ->route('subKategori.index')->with('success', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubKategori  $subKategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subKategoris = subKategori::findOrFail($id);
        $subKategoris->delete();
        return redirect()
            ->route('subKategori.index')->with('success', 'Data has been deleted');

    }

    public function getSubKategori($id)
    {
        $sub_kategoris = SubKategori::where('kategori_id', $id)->get();
        return response()->json($sub_kategoris);
    }
}
