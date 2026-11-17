<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Observatorium Langit Gelap')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="celestial-body">

    <div class="celestial-shell">

        <!-- HEADER DAN NAVIGASI -->
        <header class="celestial-header">

            <a href="{{ route('dashboard') }}" class="celestial-brand">
                <span class="brand-symbol">✦</span>

                <span class="brand-name">
                    <strong>ASTRA.</strong>
                    <small>OBSERVATORIUM LANGIT GELAP</small>
                </span>
            </a>

            <nav class="celestial-nav">

                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('lokasi.index') }}"
                   class="{{ request()->routeIs('lokasi.*') ? 'active' : '' }}">
                    Lokasi
                </a>

                <a href="{{ route('kegiatan.index') }}"
                   class="{{ request()->routeIs('kegiatan.*') ? 'active' : '' }}">
                    Kegiatan
                </a>

                <a href="{{ route('peserta.index') }}"
                   class="{{ request()->routeIs('peserta.*') ? 'active' : '' }}">
                    Peserta
                </a>

                <a href="{{ route('perlengkapan.index') }}"
                   class="{{ request()->routeIs('perlengkapan.*') ? 'active' : '' }}">
                    Perlengkapan
                </a>

            </nav>

            <div class="celestial-header-info">
    <span class="header-star">✧</span>
    <span>Observation Center</span>

    <form action="{{ route('logout') }}" method="POST" style="margin-left: 18px;">
        @csrf

        <button type="submit" class="logout-button">
            <span>↪</span> Logout
        </button>
    </form>
</div>

        </header>

        <!-- KONTEN HALAMAN -->
        <main class="celestial-main">

            <div class="celestial-page-heading">
                <div>
                    <span class="page-eyebrow">
                        ✦ CELESTIAL OBSERVATION MANAGEMENT
                    </span>

                    <h1>@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="page-date">
                    <span>✧</span>
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>

            <section class="celestial-content">
                @yield('content')
            </section>

        </main>

        <!-- FOOTER -->
        <footer class="celestial-footer">
            <div>
                <strong>ASTRA.</strong>
                <span>Exploring the universe, one night at a time.</span>
            </div>

            <p>
                © {{ date('Y') }} Observatorium Langit Gelap
            </p>
        </footer>

    </div>

</body>
</html>
