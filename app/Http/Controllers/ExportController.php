<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RiwayatProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $riwayatProduks = RiwayatProduk::whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])->get();

        if ($request->tanggal_awal > $request->tanggal_akhir) {
            return back()->with('error','invalid date');
        }
        if ($request->type == 'pdf') {
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('admin.export.pdf', compact('riwayatProduks'));
            return $pdf->stream();
        } else {
            return "excel";
        }
    }
}
