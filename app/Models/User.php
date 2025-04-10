<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Alamat;
use App\Models\DetailTransaksi;
use App\Models\Keranjang;
use App\Models\RefundProduk;
use App\Models\ReviewProduk;
use App\Models\TopUp;
use App\Models\Transaksi;
use App\Models\VoucherUser;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function image()
    {
        if ($this->profile && file_exists(public_path($this->profile))) {
            return asset($this->profile);
        } else {
            return asset('images/users/profile.jpeg');
        }
    }

    public function deleteImage()
    {
        if ($this->profile && file_exists(public_path($this->profile))) {
            return unlink(public_path($this->profile));
        }
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function alamat()
    {
        return $this->hasMany(Alamat::class);
    }

    public function voucherUser()
    {
        return $this->hasMany(VoucherUser::class);
    }

    public function topup()
    {
        return $this->hasMany(TopUp::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function reviewProduk()
    {
        return $this->hasMany(ReviewProduk::class);
    }

    public function refundProduk()
    {
        return $this->hasMany(RefundProduk::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'no_telepon',
        'jenis_kelamin',
        'tanggal_lahir',
        'password',
        'status',
        'profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
