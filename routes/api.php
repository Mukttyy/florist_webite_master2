<?php

use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/produk', [ProdukController::class, 'apiIndex']);
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/specials', [ProdukController::class, 'special']);

Route::resource('/dashboard/departments', 'DepartmentsController');