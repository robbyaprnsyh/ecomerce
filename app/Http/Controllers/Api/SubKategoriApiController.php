<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubKategoriApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $subKategoris = SubKategori::with('kategori')->latest()->get();
        return response()->json($subKategoris);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'name' => 'required|string|max:255',
        ]);

        $subKategori = SubKategori::create($validated);
        return response()->json(['message' => 'Data has been added', 'data' => $subKategori], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $subKategori = SubKategori::with('kategori')->findOrFail($id);
        return response()->json($subKategori);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'name' => 'required|string|max:255',
        ]);

        $subKategori = SubKategori::findOrFail($id);
        $subKategori->update($validated);
        return response()->json(['message' => 'Data has been updated', 'data' => $subKategori]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $subKategori = SubKategori::findOrFail($id);
        $subKategori->delete();
        return response()->json(['message' => 'Data has been deleted']);
    }

    /**
     * Get subcategories based on category ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubKategori($id)
    {
        $subKategoris = SubKategori::where('kategori_id', $id)->get();
        return response()->json($subKategoris);
    }
}
