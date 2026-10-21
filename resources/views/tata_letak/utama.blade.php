
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI PANTAU TPS Indramayu')</title>

    <style>
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #123f38;
            background: #e0f8f8;
            line-height: 1.6;
        }

        .site-navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #fff;
            border-bottom: 1px solid #d8eeee;
        }

        .nav-inner {
            width: min(1180px, 92%);
            min-height: 76px;
            margin: auto;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #07594f;
            font-size: 15px;
            font-weight: 800;
            line-height: 1.4;
            text-decoration: none;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: #07594f;
            color: #fff;
            font-size: 23px;
        }

        .brand small {
            color: #66827e;
            font-size: 11px;
            letter-spacing: 1.2px;
            font-weight: 600;
        }

        .nav-menu {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 28px;
        }

        .nav-menu a {
            min-height: 76px;
            display: flex;
            align-items: center;
            padding-top: 3px;
            border-bottom: 3px solid transparent;
            color: #526e68;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: #07594f;
            border-bottom-color: #14a99a;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .nav-actions form { margin: 0; }

        .nav-btn {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 17px;
            border: 1px solid transparent;
            border-radius: 9px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            cursor: pointer;
        }

        .nav-btn-outline {
            color: #07594f;
            background: white;
            border-color: #c9e3df;
        }

        .nav-btn-primary {
            color: white;
            background: #07594f;
            border-color: #07594f;
        }

        .nav-btn-primary:hover { background: #043f38; }

        main { min-height: 65vh; }

        .site-footer {
            padding: 25px 20px;
            background: #062e2b;
            color: #d7f4f0;
            text-align: center;
            font-size: 12px;
        }

        .site-footer p { margin: 0; }

        @media (max-width: 760px) {
            .nav-inner {
                grid-template-columns: 1fr auto;
                gap: 8px;
                padding: 10px 0;
            }

            .brand { font-size: 12px; gap: 8px; }

            .brand-icon {
                width: 40px;
                height: 40px;
                font-size: 19px;
            }

            .brand small {
                font-size: 9px;
                letter-spacing: .7px;
            }

            .nav-actions { gap: 6px; }

            .nav-btn {
                min-height: 36px;
                padding: 8px 10px;
                font-size: 11px;
            }

            .nav-menu {
                grid-column: 1 / -1;
                grid-row: 2;
                gap: 35px;
            }

            .nav-menu a {
                min-height: 38px;
                font-size: 13px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

<header class="site-navbar">
    <div class="nav-inner">

        <a href="{{ route('home') }}" class="brand">
            <span class="brand-icon">▤</span>
            <span>
                SI PANTAU TPS<br>
                <small>KABUPATEN INDRAMAYU</small>
            </span>
        </a>

        <nav class="nav-menu">
            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'active' : '' }}">
                Beranda
            </a>

           
<a href="{{ route('data_tps.daftar') }}"
   class="{{ request()->routeIs('data-tps') ? 'active' : '' }}">
    Data TPS
</a>

        </nav>

        <div class="nav-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="nav-btn nav-btn-outline">
                    Dashboard
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-btn nav-btn-primary">
                        Keluar
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-btn nav-btn-outline">
                    Masuk
                </a>

                <a href="{{ route('register') }}" class="nav-btn nav-btn-primary">
                    Daftar
                </a>
            @endauth
        </div>

    </div>
</header>

<main>
    @yield('content')
</main>

<footer class="site-footer">
    <p>
        &copy; {{ date('Y') }} SI PANTAU TPS &middot;
        Sistem Informasi Pelaporan dan Monitoring TPS Sampah
    </p>
</footer>

@stack('scripts')

</body>
</html>
