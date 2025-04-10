<?php

namespace App\Models;

use App\Models\Alamat;
use App\Models\DetailTransaksi;
use App\Models\Keranjang;
use App\Models\MetodePembayaran;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function metodePembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class, 'metodePembayaran_id');
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }
}
