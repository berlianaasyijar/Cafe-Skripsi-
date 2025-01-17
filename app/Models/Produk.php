<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'kategori',
        'deskripsi',
        'harga',
        'gambar_produk',
        'status',
        'creaby',
        'creadate',
        'updatedby',
        'updateddate',
    ];
}
