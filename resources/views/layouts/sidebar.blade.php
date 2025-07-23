<!-- resources/views/layouts/sidebar.blade.php -->
<div class="sidebar">
  <h2>AdminVinskanna</h2>
  <a href="{{ route('admin.beranda') }}"><i class="fas fa-home"></i> Beranda</a>
  <a href="{{ route('admin.produk') }}"><i class="fas fa-box"></i> Produk</a>
  <a href="{{ route('admin.pesanan') }}"><i class="fas fa-shopping-cart"></i> Pesanan</a>
  <a href="{{ route('admin.pengguna') }}"><i class="fas fa-users"></i> Pengguna</a>
  <a href="{{ route('admin.kontak') }}"><i class="fas fa-envelope"></i> Kontak Masuk</a>
</div>
