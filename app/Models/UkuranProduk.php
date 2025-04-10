<?php

namespace App\Models;

use App\Models\Produk;
use App\Models\Ukuran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkuranProduk extends Model
{
    use HasFactory;

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class,'ukuran_id');
    }
}
