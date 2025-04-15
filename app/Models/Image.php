<?php
namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function image()
    {
        if ($this->gambar_produk && file_exists(public_path($this->gambar_produk))) {
            return asset($this->gambar_produk);
        }
    }

    public function deleteImage()
    {
        if ($this->gambar_produk && file_exists(public_path($this->gambar_produk))) {
            return unlink(public_path($this->gambar_produk));
        }
    }
}
