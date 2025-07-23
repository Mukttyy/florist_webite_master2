<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manajemen Produk | Admin Vinskanna</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    /* (Gabungan dari style sidebar + konten produk) */
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
    }

    .sidebar {
      width: 220px;
      background-color: #d5a4c2;
      color: white;
      height: 100vh;
      padding: 20px 0;
      position: fixed;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 20px;
      font-weight: bold;
    }

    .sidebar a {
      display: block;
      padding: 12px 20px;
      color: white;
      text-decoration: none;
      transition: 0.3s;
    }

    .sidebar a:hover {
      background-color: #b57ba3;
    }

    .content {
      margin-left: 220px;
      padding: 20px;
      background-color: #f8f8f8;
      width: 100%;
      min-height: 100vh;
    }

    h1.title {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .alert-success {
      padding: 10px;
      background: #c9f7c9;
      border: 1px solid #93d893;
      color: #2d7b2d;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #eee;
      text-align: left;
    }

    th {
      background-color: #d5a4c2;
      color: white;
    }

    input[type="text"], input[type="number"], input[type="file"] {
      width: 100%;
      padding: 8px;
      margin: 5px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      background-color: #d5a4c2;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 6px;
      cursor: pointer;
    }

    .product-img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 5px;
    }

    .aksi-buttons {
      display: flex;
      gap: 10px;
    }

    .option-btn, .delete-btn {
      padding: 6px 10px;
      font-size: 13px;
      text-decoration: none;
      color: white;
      border-radius: 5px;
    }

    .option-btn {
      background-color: #f39c12;
    }

    .delete-btn {
      background-color: #e74c3c;
    }

    select {
        width: 100%;
        padding: 8px;
        margin: 5px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
  </style>
</head>
<body>

    @include('admin.sidebar')
  {{-- Sidebar --}}
  {{-- <div class="sidebar">
    <h2>AdminVinskanna</h2>
    <a href="{{ route('admin.beranda') }}"><i class="fas fa-home"></i> Beranda</a>
    <a href="{{ route('admin.produk') }}"><i class="fas fa-box"></i> Produk</a>
    <a href="{{ route('admin.pesanan') }}"><i class="fas fa-shopping-cart"></i> Pesanan</a>
  </div> --}}

  {{-- Main Content --}}
  <div class="content">
    <h1 class="title">Manajemen Produk</h1>

    {{-- Flash Message --}}
    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Tambah Produk --}}
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <table>
        <thead>
          <tr>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Special?</th>
            <th>Tambah</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" name="nama" required></td>
            <td>
                <select name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoriList as $kategori)
                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="harga" required></td>
            <td><input type="file" name="gambar" accept="image/*" required></td>
            <td style="text-align: center;"><input type="checkbox" name="is_special" value="1"></td>
            <td><input type="submit" value="Tambah Produk"></td>
          </tr>
        </tbody>
      </table>
    </form>

    {{-- Daftar Produk --}}
    <h2 style="margin-top: 30px;">Daftar Produk</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Gambar</th>
          <th>Nama</th>
          <th>Kategori</th>
          <th>Harga</th>
          <th>Special</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($produks as $produk)
        <tr>
          <td>#{{ $produk->id }}</td>
          <td>
            @if($produk->gambar)
              <img src="{{ asset('flowers/' . $produk->gambar) }}" alt="Gambar Produk" class="product-img">
            @else
              -
            @endif
          </td>
          <td>{{ $produk->nama }}</td>
          <td>{{ $produk->kategori }}</td>
          <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
          <td>{{ $produk->is_special ? 'Ya' : 'Tidak' }}</td>
          <td>
            <div class="aksi-buttons">
              {{-- Tambahkan fitur edit jika diperlukan --}}
              {{-- <a href="#" class="option-btn">Edit</a> --}}
              <a href="{{ route('admin.hapusProduk', $produk->id) }}" class="delete-btn" onclick="return confirm('Hapus produk ini?')">Hapus</a>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" style="text-align:center;">Belum ada produk</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</body>
</html>
