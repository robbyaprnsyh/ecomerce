<?php

namespace App\Models;

use App\Models\Alamat;
use App\Models\Kecamatan;
use App\Models\Kota;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kota()
    {
        return $this->hasMany(Kota::class);
    }

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function alamat()
    {
        return $this->hasMany(Alamat::class);
    }
}
