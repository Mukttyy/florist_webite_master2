<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'nama_pelanggan',
        'tanggal_pesan',
        'total_harga',
        'metode_pembayaran',
        'status'
    ];
}
