<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Produk;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produks,id'
        ]);

        Wishlist::create([
            'id_produk' => $request->id_produk
        ]);

        return response()->json(['message' => 'Wishlist saved']);
    }

    public function index()
    {
        $wishlist = Wishlist::with('product')->get();
        return view('wishlist', compact('wishlist'));
    }
}
