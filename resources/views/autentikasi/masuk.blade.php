
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk | SI PANTAU TPS</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }
        .container {
            max-width: 420px;
            margin: 70px auto;
            padding: 28px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 8px 28px #00000012;
        }
        h1 { margin-top: 0; }
        label {
            display: block;
            margin: 16px 0 7px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }
        button {
            width: 100%;
            padding: 13px;
            margin-top: 20px;
            border: 0;
            border-radius: 8px;
            background: #15803d;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            background: #dcfce7;
            color: #166534;
        }
        .error { color: #b91c1c; margin-top: 8px; }
        a { color: #15803d; }
    </style>
</head>
<body>
<div class="container">
    <h1>Masuk</h1>
    <p>Masuk ke akun SI PANTAU TPS.</p>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <label for="email">Email</label>
        <input id="email" name="email" type="email"
               value="{{ old('email') }}" required autofocus>

        <label for="password">Kata sandi</label>
        <input id="password" name="password" type="password" required>

        <label>
            <input type="checkbox" name="remember" value="1"
                   style="width:auto">
            Ingat saya
        </label>

        <button type="submit">Masuk</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
</div>
</body>
</html>
