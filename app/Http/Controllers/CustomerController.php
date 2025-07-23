<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class CustomerController extends Controller
{
    public function index()
    {
        $produks = Produk::all(); // semua produk
        $specials = Produk::where('is_special', true)->get(); // produk spesial
        $specials = Produk::where('kategori', 'special')->get();

        return view('index', compact('produks', 'specials'));
    }
}
