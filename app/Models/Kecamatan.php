<?php

namespace App\Models;

use App\Models\Alamat;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function alamat()
    {
        return $this->hasMany(Alamat::class);
    }
}
