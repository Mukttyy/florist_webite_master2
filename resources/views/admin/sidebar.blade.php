<div class="sidebar">
    <h2><strong>Admin</strong>Vinskanna</h2>
    <a href="{{ route('admin.beranda') }}" class="{{ Route::is('admin.beranda') ? 'active' : '' }}">
        <i class="fas fa-home"></i> Beranda
    </a>
    <a href="{{ route('admin.pesanan') }}" class="{{ Route::is('admin.pesanan*') ? 'active' : '' }}">
        <i class="fas fa-shopping-cart"></i> Pesanan
    </a>
    <a href="{{ route('admin.produk') }}" class="{{ Route::is('admin.produk*') ? 'active' : '' }}">
        <i class="fas fa-box"></i> Produk
    </a>
    <a href="#" class="{{ Route::is('admin.pengguna*') ? 'active' : '' }}">
        <i class="fas fa-users"></i> Pengguna
    </a>
    <a href="#" class="{{ Route::is('admin.kontak*') ? 'active' : '' }}">
        <i class="fas fa-envelope"></i> Kontak Masuk
    </a>

    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        class="logout-btn">
        <i class="fas fa-sign-out-alt"></i> Keluar
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
