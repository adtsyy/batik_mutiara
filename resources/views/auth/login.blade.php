<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT Batik Mutiara</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #7a3300, #c6711f);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 380px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.2);
            text-align: center;
        }

        .logo img {
            width: 120px;
        }

        h2 {
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: 700;
            color: #6f2b00;
        }

        p.subtitle {
            margin-top: 0;
            color: #555;
            font-size: 14px;
        }

        .form-group {
            text-align: left;
            margin-top: 15px;
        }

        label {
            font-size: 14px;
            font-weight: bold;
            color: #444;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 5px;
            font-size: 14px;
        }

        .btn-login {
            margin-top: 20px;
            width: 100%;
            background: #8a3b00;
            color: #fff;
            padding: 10px;
            border-radius: 6px;
            border: none;
            font-size: 15px;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #703000;
        }

        .demo-box {
            margin-top: 20px;
            background: #fff8df;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            text-align: left;
            border-left: 3px solid #c99a29;
        }
    </style>
</head>
<body>

<div class="login-box">

    <div class="logo">
        <img src="/logo.png" alt="Logo">
    </div>

    <h2>PT BATIK MUTIARA</h2>
    <p class="subtitle">Sistem Informasi Penjualan</p>

    @if (session('error'))
        <p style="color:red; font-size:13px;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn-login">→ Login</button>
    </form>

</div>

</body>
</html>
