<?php

namespace App\Models;

use App\Models\Produk;
use App\Models\SubKategori;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    public function subKategori()
    {
        return $this->hasMany(SubKategori::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
    // public static function boot()
    // {
    //     parent::boot();
    //     self::deleting(function ($var) {
    //         if ($var->subKategori->count() > 0 || $var->produk->count() > 0) {
    //             return false;
    //         }
    //     });
    // }
}
