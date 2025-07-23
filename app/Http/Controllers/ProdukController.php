<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return response()->json(Produk::all());
    }

    public function special()
    {
        return response()->json(Produk::where('is_special', true)->get());

    }

    public function apiIndex()
    {
        return Produk::all();
    }

    public function home()
    {
        $products = Produk::all();
        return view('index', compact('products'));
    }
}
