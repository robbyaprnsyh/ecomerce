<?php

namespace App\Http\Controllers;

use App\Models\Ukuran;
use Illuminate\Http\Request;

class UkuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ukurans = Ukuran::latest()->get();
        return view('admin.ukuran.index', compact('ukurans'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ukuran.create');
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
            'ukuran' => 'required|unique:ukurans',
        ]);

        $ukurans = new Ukuran();
        $ukurans->ukuran = $request->ukuran;
        $ukurans->save();
        return redirect()
            ->route('ukuran.index')->with('success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ukuran  $ukuran
     * @return \Illuminate\Http\Response
     */
    public function show(Ukuran $ukuran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ukuran  $ukuran
     * @return \Illuminate\Http\Response
     */
    public function edit(Ukuran $ukuran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ukuran  $ukuran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ukuran $ukuran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ukuran  $ukuran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ukurans = Ukuran::findOrFail($id);
        $ukurans->delete();
        return redirect()
            ->route('ukuran.index')->with('success', 'Data has been deleted');

    }
}
