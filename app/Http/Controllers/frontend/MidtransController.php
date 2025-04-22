<?php
namespace App\Http\Controllers\frontend;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaksi;
use App\Http\Controllers\Controller;

class MidtransController extends Controller
{
    public function getSnapToken($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        $params = [
            'transaction_details' => [
                'order_id' => $transaksi->kode_transaksi . '-' . time(),
                'gross_amount' => $transaksi->total_harga,
            ],
            'customer_details'    => [
                'first_name' => auth()->user()->name,
                'email'      => auth()->user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        return response()->json(['snap_token' => $snapToken]);  
    }
}
