<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Attire')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }
        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 10px 0;
        }
        .sidebar a:hover {
            text-decoration: underline;
        }
        .content {
            flex: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <a href="{{ route('admin.beranda') }}">Beranda</a>
        <a href="{{ route('admin.orders') }}">Orders</a>
        <a href="{{ route('admin.pesanan') }}">Pesanan</a>
        <a href="{{ route('admin.produk') }}">Produk</a>
        <a href="{{ route('admin.pengguna') }}">Pengguna</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mt-3">Logout</button>
        </form>
    </div>
    <div class="content">
        @yield('content')
    </div>

    <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
