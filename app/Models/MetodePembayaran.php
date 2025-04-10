<?php

namespace App\Models;

use App\Models\TopUp;
use App\Models\Transaksi;
use App\Models\VoucherUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    public function topUp()
    {
        return $this->hasMany(TopUp::class);
    }

    public function voucherUser()
    {
        return $this->hasMany(VoucherUser::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
