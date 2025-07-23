<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bloomify</title>
    <link rel="stylesheet" href="login.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background-color: #fefefe;
        }

        .login-container {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        .login-left {
            flex: 1;
            background-color: #f1f1f1;
            overflow: hidden;
        }

        .login-left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-right {
            flex: 1;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .form-box {
            width: 100%;
            max-width: 400px;
        }

        .form-box h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 5px;
        }

        .form-box .brand {
            color: #d63384;
            font-weight: bold;
        }

        .form-box h3 {
            color: #666;
            margin-bottom: 30px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: #d63384;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s ease;
        }

        .login-btn:hover {
            background: #c2186a;
        }

        .error-msg {
            background: #ffd5d5;
            color: #a10000;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
        }

        .success-msg {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
        }

        form p {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
        }

        form p a {
            color: #d63384;
            text-decoration: none;
        }

        form p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-left">
            <img src="{{ asset('images/asset/benner blog2.jpg') }}" alt="Florist Image">
        </div>
        <div class="login-right">
            <div class="form-box">
                <h2><span class="brand">Bloom</span>ify</h2>
                <h3>Login ke akun kamu</h3>

                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="error-msg">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                {{-- Tampilkan pesan sukses jika ada --}}
                @if (session('success'))
                    <div
                        style="background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:15px;">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ url('/login') }}">
                    @csrf
                    <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}"
                        required>
                    <input type="password" name="password" placeholder="Masukkan Password" required>
                    <input type="submit" value="Masuk Sekarang" class="login-btn">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Buat akun</a></p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
