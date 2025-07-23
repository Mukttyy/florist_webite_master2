<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesananController extends Controller
{
    protected $table = 'pesanans';
    protected $fillable = [
        'nama_pelanggan', 'tanggal', 'total_harga', 'metode_pembayaran', 'status'
    ];
}
