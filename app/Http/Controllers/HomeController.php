<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        $produks = Produk::all(); // untuk Collection
        $specials = Produk::where('kategori', 'special')->get(); // untuk Special Product

        return view('index', compact('produks', 'specials'));
    }
}
