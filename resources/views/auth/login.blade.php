<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem KGB</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('images/bg-login.png') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }
        .login-box {
            background: rgba(255,255,255,0.9);
            border-radius: 15px;
            padding: 30px;
            max-width: 400px;
            margin: 100px auto;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 80px;
        }
        .btn-primary {
            background-color: #1e1b4b;
            border-color: #1e1b4b;
        }
        .btn-primary:hover {
            background-color: #2c2a6b;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="logo">
            <img src="{{ asset('images/logo-pengayoman.png') }}" alt="Logo Pengayoman">
            <h5 class="mt-3 fw-bold">Sistem Kenaikan Gaji Berkala</h5>
        </div>

        {{-- Pesan Error --}}
        @if ($errors->any())
            <div class="alert alert-danger p-2">
                <small>{{ $errors->first() }}</small>
            </div>
        @endif

        {{-- Pesan Sukses (Logout) --}}
        @if (session('success'))
            <div class="alert alert-success p-2">
                <small>{{ session('success') }}</small>
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
