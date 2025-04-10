<?php

namespace App\Models;

use App\Models\UkuranProduk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    use HasFactory;

    public function ukuranProduk()
    {
        return $this->hasMany(UkuranProduk::class);
    }

    public function produk()
    {
        return $this->belongsToMany(Ukuran::class,'ukuran_produks');
    }
}
