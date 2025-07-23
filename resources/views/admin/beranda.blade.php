<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin Vinskanna</title>
    <style>
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

        .header {
            background-color: #c998bb;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
        }

        .dashboard-title {
            font-size: 22px;
            font-weight: bold;
            margin-top: 20px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            flex: 1 1 calc(25% - 20px);
            min-width: 200px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card i {
            font-size: 24px;
            color: #8c2d67;
        }

        .card-title {
            font-weight: bold;
            margin-top: 10px;
            color: #333;
        }

        .card-value {
            font-size: 18px;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .card {
                flex: 1 1 100%;
            }
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    @include('admin.sidebar')
    {{-- <div class="sidebar"> --}}
    {{-- <h2>AdminVinskanna</h2> --}}
    {{-- <a href="{{ route('admin.beranda') }}"><i class="fas fa-home"></i> Beranda</a> --}}
    {{-- <a href="{{ route('admin.produk') }}"><i class="fas fa-box"></i> Produk</a> --}}
    {{-- <a href="{{ route('admin.pesanan') }}"><i class="fas fa-shopping-cart"></i> Pesanan</a> --}}
    {{-- Tambahkan route khusus jika punya halaman kontak/pengguna --}}
    {{-- <a href="{{ route('admin.pengguna') }}"><i class="fas fa-users"></i> Pengguna</a> --}}
    {{-- <a href="{{ route('admin.kontak') }}"><i class="fas fa-envelope"></i> Kontak Masuk</a> --}}

    {{-- </div> --}}

    <div class="content">
        <div class="header">Selamat datang di dashboard</div>

        <div class="dashboard-title">BERANDA</div>

        <div class="card-container">
            <div class="card">
                <i class="fas fa-clock"></i>
                <div class="card-title">TOTAL PENDING</div>
                <div class="card-value">0 K</div>
            </div>

            <div class="card">
                <i class="fas fa-check-circle"></i>
                <div class="card-title">PEMBAYARAN BERHASIL</div>
                <div class="card-value">120 K</div>
            </div>

            <div class="card">
                <i class="fas fa-shopping-cart"></i>
                <div class="card-title">PEMESANAN DILAKUKAN</div>
                <div class="card-value">2</div>
            </div>

            <div class="card">
                <i class="fas fa-box"></i>
                <div class="card-title">PRODUK DITAMBAHKAN</div>
                <div class="card-value">9</div>
            </div>

            <div class="card">
                <i class="fas fa-user"></i>
                <div class="card-title">PENGGUNA NORMAL</div>
                <div class="card-value">3</div>
            </div>

            <div class="card">
                <i class="fas fa-user-shield"></i>
                <div class="card-title">PENGGUNA ADMIN</div>
                <div class="card-value">1</div>
            </div>

            <div class="card">
                <i class="fas fa-users"></i>
                <div class="card-title">TOTAL AKUN</div>
                <div class="card-value">4</div>
            </div>

            <div class="card">
                <i class="fas fa-envelope-open-text"></i>
                <div class="card-title">PESAN BARU</div>
                <div class="card-value">1</div>
            </div>
        </div>
    </div>

</body>

</html>
