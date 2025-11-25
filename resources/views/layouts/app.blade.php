<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT BATIK MUTIARA</title>

    <style>
        body {
            margin: 0;
            background: #fffef5;
            font-family: "Segoe UI", sans-serif;
        }

        /* NAVBAR */
        .navbar {
            background: #8b4e16;
            color: white;
            padding: 15px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 22px;
            font-weight: bold;
        }

        .brand small {
            display: block;
            font-size: 12px;
            margin-top: -5px;
        }

        .menu {
            display: flex;
            gap: 30px;
        }

        .menu a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        /* CONTENT */
        .container {
            padding: 30px 50px;
        }

        /* CARD */
        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.08);
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table thead {
            background: #f3f3f3;
        }

        table th, table td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 6px;
            background: #eee;
        }

        .btn-icon {
            padding: 8px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background: #f6f6f6;
            margin-left: 5px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="brand">
            <img src="/logo.png" width="48">
            <div>
                PT BATIK MUTIARA
                <small>Administrator Panel</small>
            </div>
        </div>

        <div class="menu">
            <a href="/dashboard">Dashboard</a>
            <a href="/admin/cashiers">Kasir</a>
            <a href="/admin/products">Produk</a>
            <a href="/admin/sales">Penjualan</a>
        </div>

        <div>
            Administrator |
            <button class="btn-icon" style="background:#fff;color:#8b4e16;">Logout</button>
        </div>
    </div>

    <!-- TEMPAT KONTEN -->
    <div class="container">
        @yield('content')
    </div>

</body>
</html>
