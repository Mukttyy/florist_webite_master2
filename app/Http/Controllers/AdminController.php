<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function beranda()
    {
        $totalPending = Pesanan::where('status', 'Pending')->count();
        $pembayaranBerhasil = Pesanan::where('status', 'Selesai')->count();
        $totalPesanan = Pesanan::count();
        $produkCount = Produk::count();
        $userNormal = User::where('role', 'customer')->count();
        $userAdmin = User::where('role', 'admin')->count();
        $totalAkun = User::count();
        $pesanBaru = 1; // Simpan manual atau ambil dari tabel kontak

        return view('admin.beranda', compact(
            'totalPending',
            'pembayaranBerhasil',
            'totalPesanan',
            'produkCount',
            'userNormal',
            'userAdmin',
            'totalAkun',
            'pesanBaru'
        ));
    }

    public function pesanan()
    {
        $pesanans = Pesanan::all();
        return view('admin.pesanan', compact('pesanans'));
    }

    public function storePesanan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required|string|max:255',
            'total_harga' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string',
            'status' => 'required|in:Pending,Selesai,Dibatalkan',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Gagal menambahkan pesanan. Periksa kembali input Anda.');
        }

        Pesanan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'total_harga' => $request->total_harga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => $request->status,
            'tanggal_pesan' => now(), // Tanggal otomatis diisi
        ]);

        return back()->with('success', 'Pesanan baru berhasil ditambahkan.');
    }

    /**
     * Memperbarui pesanan yang ada (Update)
     */
    public function updatePesanan(Request $request, Pesanan $pesanan)
    {
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required|string|max:255',
            'total_harga' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string',
            'status' => 'required|in:Pending,Selesai,Dibatalkan',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Gagal memperbarui pesanan.');
        }

        $pesanan->update($request->all());

        return back()->with('success', "Pesanan #{$pesanan->id} berhasil diperbarui.");
    }

    /**
     * Menghapus pesanan (Delete)
     */
    public function destroyPesanan(Pesanan $pesanan)
    {
        $pesanan->delete();
        return back()->with('success', "Pesanan #{$pesanan->id} berhasil dihapus.");
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return back()->with('success', 'Status diperbarui.');
    }

    public function deletePesanan($id)
    {
        Pesanan::destroy($id);
        return back()->with('success', 'Pesanan dihapus.');
    }

    public function produk()
    {
        $produks = Produk::all();
        $kategoriList = ['Bunga Segar', 'Karangan Bunga', 'Bucket', 'Dekorasi']; // Tambah ini

        return view('admin.produk', compact('produks', 'kategoriList'));
    }

    public function tambahProduk(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'is_special' => 'nullable|boolean'
        ]);

        $gambarName = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('flowers'), $gambarName);

        //Produk::create($request->all());
        Produk::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'gambar' => $gambarName,
            'is_special' => $request->has('is_special')
        ]);


        return redirect()->route('admin.produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function editProduk(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_special' => 'nullable|boolean'
        ]);

        $data = $request->only('nama', 'kategori', 'harga', 'is_special');

        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('flowers'), $gambarName);
            $data['gambar'] = $gambarName;
        }

        $produk->update($data);

        return back()->with('success', 'Produk berhasil diperbarui.');
    }

    public function hapusProduk($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar jika ada
        $gambarPath = public_path('flowers/' . $produk->gambar);
        if (file_exists($gambarPath)) {
            unlink($gambarPath);
        }

        $produk->delete();

        return back()->with('success', 'Produk dihapus.');
    }
}
