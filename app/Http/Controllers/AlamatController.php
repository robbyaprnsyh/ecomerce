<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alamats = Alamat::with('user', 'provinsi', 'kota', 'kecamatan')->latest()->get();
        return view('admin.alamat.index', compact('alamats'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsis = Provinsi::all();
        $users = User::where('role', 'costumer')->get();
        return view('admin.alamat.create', compact('provinsis', 'users'));

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
            'nama_lengkap' => 'required',
            'no_telepon' => 'required',
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'kecamatan_id' => 'required',
            'alamat_lengkap' => 'required',
        ]);

        $alamats = new Alamat();
        $alamats->user_id = $request->user_id;
        $alamats->nama_lengkap = $request->nama_lengkap;
        $alamats->no_telepon = $request->no_telepon;
        $alamats->provinsi_id = $request->provinsi_id;
        $alamats->kota_id = $request->kota_id;
        $alamats->kecamatan_id = $request->kecamatan_id;
        $alamats->alamat_lengkap = $request->alamat_lengkap;
        $alamats->detail_lainnya = $request->detail_lainnya;
        $alamats->label_alamat = $request->label_alamat;
        $alamats->save();
        return redirect()
            ->route('alamats.index')->with('success', 'Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alamats = Alamat::findOrFail($id);
        $provinsis = Provinsi::all();
        $users = User::where('role', 'costumer')->get();
        $kotas = Kota::where('provinsi_id', $alamats->provinsi_id)->get();
        $kecamatans = Kecamatan::where('kota_id', $alamats->kota_id)->get();
        return view('admin.alamat.edit', compact('alamats', 'provinsis', 'users', 'kecamatans', 'kotas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validasi
        $validated = $request->validate([
            'user_id' => 'required',
            'nama_lengkap' => 'required',
            'no_telepon' => 'required',
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'kecamatan_id' => 'required',
            'alamat_lengkap' => 'required',
        ]);

        $alamats = Alamat::findOrFail($id);
        $alamats->user_id = $request->user_id;
        $alamats->nama_lengkap = $request->nama_lengkap;
        $alamats->no_telepon = $request->no_telepon;
        $alamats->provinsi_id = $request->provinsi_id;
        $alamats->kota_id = $request->kota_id;
        $alamats->kecamatan_id = $request->kecamatan_id;
        $alamats->alamat_lengkap = $request->alamat_lengkap;
        $alamats->detail_lainnya = $request->detail_lainnya;
        $alamats->label_alamat = $request->label_alamat;
        $alamats->save();
        return redirect()
            ->route('alamats.index')->with('success', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alamats = Alamat::findOrFail($id);
        $alamats->delete();
        return redirect()
            ->route('alamats.index')->with('success', 'Data has been deleted');
    }
}
