<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = Kategori::latest()->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori.create');
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
            'name' => 'required|unique:kategoris',
        ]);

        $kategoris = new Kategori();
        $kategoris->name = $request->name;
        $kategoris->save();
        return redirect()
            ->route('kategori.index')->with('success', 'Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategoris = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategoris'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kategoris = Kategori::findOrFail($id);

        if ($request->name != $kategoris->name) {
            $rules['name'] = 'required|unique:kategoris';
        } else {
            $rules['name'] = 'required';
        }
        $validasiData = $request->validate($rules);

        $kategoris->name = $request->name;
        $kategoris->save();
        return redirect()
            ->route('kategori.index')->with('success', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // if (!Kategori::destroy($id)) {
        //     return redirect()->back()->with('gagal', 'Data cannot be deleted');
        // }
        $kategoris = Kategori::findOrFail($id);
        $kategoris->delete();
        return redirect()
            ->route('kategori.index')->with('success', 'Data has been deleted');

    }
}
