<?php

namespace App\Models;

use App\Models\Keranjang;
use App\Models\RefundProduk;
use App\Models\ReviewProduk;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function reviewProduk()
    {
        return $this->hasMany(ReviewProduk::class, 'detailTransaksi_id');
    }

    public function refundProduk()
    {
        return $this->hasMany(RefundProduk::class);
    }
}
