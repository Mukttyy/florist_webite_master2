<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// =======================
// Public Routes
// =======================

Route::get('/', fn() => view('login.login'));

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/cart', fn() => view('cart'));
Route::get('/search-results', fn() => view('search-results'));
Route::get('/wishlist', fn() => view('wishlist'));

// Produk (Frontend)
Route::get('/Produk', [ProdukController::class, 'index']);
Route::get('/Produk/specials', [ProdukController::class, 'special']);
Route::get('/produk', [ProdukController::class, 'apiIndex']);

// Wishlist & Keranjang
Route::get('/Keranjang', [KeranjangController::class, 'index']);
Route::post('/Keranjang/add', [KeranjangController::class, 'add']);
Route::get('/wishlist', [WishlistController::class, 'index']);
Route::post('/wishlist/add', [WishlistController::class, 'add']);
Route::post('/wishlist', [WishlistController::class, 'store']);

// =======================
// Auth Routes
// =======================

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =======================
// Admin Routes (Protected)
// =======================

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Dashboard dan halaman admin lainnya
    Route::get('/beranda', [AdminController::class, 'beranda'])->name('admin.beranda');
    Route::get('/orders', fn() => view('admin.orders'))->name('admin.orders');

    // Pesanan
    Route::get('/pesanan', [AdminController::class, 'pesanan'])->name('admin.pesanan');
    Route::post('/pesanan', [AdminController::class, 'storePesanan'])->name('admin.pesanan.store');
    Route::put('/pesanan/{pesanan}', [AdminController::class, 'updatePesanan'])->name('admin.pesanan.update');
    Route::delete('/pesanan/{pesanan}', [AdminController::class, 'destroyPesanan'])->name('admin.pesanan.destroy');

    // Produk
    Route::get('/produk', [AdminController::class, 'produk'])->name('admin.produk');
    Route::post('/produk', [AdminController::class, 'tambahProduk'])->name('admin.produk.store');
    Route::get('/produk/hapus/{id}', [AdminController::class, 'hapusProduk'])->name('admin.hapusProduk');
    Route::post('/produk/edit/{id}', [AdminController::class, 'editProduk'])->name('admin.produk.edit');
});

// =======================
// Debug/Test Route
// =======================

Route::get('/test-admin', fn() => 'Halo admin!')->middleware('admin');
