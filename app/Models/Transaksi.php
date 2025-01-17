<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['total_harga', 'bukti_pembayaran', 'created_by', 'status'];

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }
}
