<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ASTRA. | Observatorium Langit Gelap</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #F2ECF8;
            color: #44364E;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* HEADER */
        .public-header {
            background: #A9D7EE;
            padding: 18px 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
            flex-wrap: wrap;
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 27px;
            font-weight: 700;
            color: #44364E;
            letter-spacing: 2px;
        }

        .brand span {
            display: block;
            font-family: 'DM Sans', sans-serif;
            font-size: 10px;
            letter-spacing: 2px;
            font-weight: 600;
            margin-top: -3px;
        }

        .public-nav {
            display: flex;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .public-nav a {
            font-size: 13px;
            font-weight: 600;
            color: #44364E;
            transition: 0.3s;
        }

        .public-nav a:hover {
            color: #785A91;
        }

        .public-nav .login-link {
            background: #785A91;
            color: white;
            padding: 10px 18px;
            border-radius: 25px;
        }

        .public-nav .login-link:hover {
            background: #624879;
            color: white;
        }

        /* HERO */
        .hero {
            min-height: 570px;
            padding: 90px 7%;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 75% 35%, rgba(169, 215, 238, 0.75), transparent 25%),
                radial-gradient(circle at 85% 75%, rgba(169, 135, 197, 0.45), transparent 30%),
                linear-gradient(120deg, #E8DDF2, #DDECF7, #F2ECF8);
        }

        .hero-content {
            max-width: 650px;
            position: relative;
            z-index: 2;
        }

        .hero-label {
            display: inline-block;
            background: rgba(255,255,255,0.65);
            color: #785A91;
            padding: 9px 17px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 23px;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(38px, 5vw, 65px);
            line-height: 1.15;
            color: #44364E;
            margin-bottom: 22px;
        }

        .hero h1 span {
            color: #785A91;
        }

        .hero p {
            font-size: 15px;
            line-height: 1.9;
            color: #695C72;
            max-width: 550px;
            margin-bottom: 30px;
        }

        .hero-button {
            display: inline-block;
            background: #785A91;
            color: white;
            padding: 14px 25px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            transition: 0.3s;
        }

        .hero-button:hover {
            background: #624879;
            transform: translateY(-3px);
        }

        .moon {
            position: absolute;
            right: 12%;
            top: 18%;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FFFFFF, #D8C8E8, #A9D7EE);
            box-shadow: 0 0 70px rgba(120, 90, 145, 0.25);
            opacity: 0.8;
        }

        .orbit {
            position: absolute;
            right: 5%;
            top: 10%;
            width: 390px;
            height: 390px;
            border: 1px solid rgba(120, 90, 145, 0.25);
            border-radius: 50%;
            transform: rotate(-25deg);
        }

        .orbit::after {
            content: '';
            position: absolute;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #785A91;
            top: 15%;
            left: 18%;
        }

        /* ABOUT */
        .about-section {
            padding: 85px 7%;
            text-align: center;
        }

        .section-label {
            color: #9275AA;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            margin-bottom: 13px;
        }

        .about-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            color: #44364E;
            margin-bottom: 15px;
        }

        .section-description {
            max-width: 650px;
            margin: 0 auto 45px;
            color: #81748A;
            font-size: 14px;
            line-height: 1.8;
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            text-align: left;
        }

        .about-card {
            background: white;
            padding: 32px;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(91, 68, 112, 0.06);
            transition: 0.3s;
        }

        .about-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 35px rgba(91, 68, 112, 0.12);
        }

        .card-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #EDE5F5;
            border-radius: 14px;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .about-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 21px;
            margin-bottom: 12px;
            color: #44364E;
        }

        .about-card p {
            color: #897E90;
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .info-link {
            display: inline-block;
            color: #785A91;
            font-size: 13px;
            font-weight: 700;
            transition: 0.3s;
        }

        .info-link:hover {
            color: #A987C5;
            transform: translateX(4px);
        }

        /* CLOSING */
        .closing-section {
            margin: 0 7% 80px;
            padding: 55px 30px;
            text-align: center;
            border-radius: 22px;
            background: linear-gradient(120deg, #DCECF6, #E8DDF2);
        }

        .closing-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            margin-bottom: 15px;
        }

        .closing-section p {
            color: #756780;
            font-size: 14px;
            line-height: 1.8;
            max-width: 600px;
            margin: 0 auto 25px;
        }

        /* FOOTER */
        .public-footer {
            background: #A9D7EE;
            padding: 28px 7%;
            text-align: center;
            color: #44364E;
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .moon {
                right: 5%;
                width: 180px;
                height: 180px;
            }

            .orbit {
                right: -5%;
                width: 300px;
                height: 300px;
            }

            .about-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .public-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .public-nav {
                gap: 14px;
            }

            .public-nav a {
                font-size: 12px;
            }

            .hero {
                min-height: 520px;
                padding-top: 70px;
            }

            .moon,
            .orbit {
                opacity: 0.25;
            }

            .about-grid {
                grid-template-columns: 1fr;
            }

            .about-section h2,
            .closing-section h2 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="public-header">
        <a href="{{ route('beranda') }}" class="brand">
            ASTRA.
            <span>OBSERVATORIUM LANGIT GELAP</span>
        </a>

        <nav class="public-nav">
            <a href="{{ route('beranda') }}">Beranda</a>
            <a href="#tentang">Tentang</a>
            <a href="{{ route('public.lokasi.index') }}">Lokasi Observasi</a>
            <a href="{{ route('public.kegiatan.index') }}">Kegiatan Observasi</a>
            <a href="{{ route('public.perlengkapan.index') }}">Perlengkapan</a>
            <a href="{{ route('login') }}" class="login-link">Login Admin</a>
        </nav>
    </header>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-content">
            <span class="hero-label">EXPLORE THE DARK SKY</span>

            <h1>
                Mengenal Langit,
                <span>Menjelajahi Semesta.</span>
            </h1>

            <p>
                Selamat datang di ASTRA, platform informasi Observatorium Langit Gelap.
                Temukan informasi lokasi pengamatan, kegiatan observasi, serta perlengkapan
                yang mendukung pengalaman menjelajahi keindahan langit malam.
            </p>

            <a href="#tentang" class="hero-button">
                Jelajahi ASTRA
            </a>
        </div>

        <div class="moon"></div>
        <div class="orbit"></div>
    </section>

    <!-- ABOUT -->
    <section class="about-section" id="tentang">
        <div class="section-label">DISCOVER ASTRA</div>

        <h2>Jelajahi Informasi Observatorium</h2>

        <p class="section-description">
            Kenali berbagai informasi yang tersedia di Observatorium Langit Gelap.
            Mulai dari lokasi pengamatan, kegiatan observasi, hingga perlengkapan
            yang digunakan untuk mendukung aktivitas pengamatan astronomi.
        </p>

        <div class="about-grid">

            <!-- LOKASI -->
            <div class="about-card">
                <div class="card-icon">🌌</div>

                <h3>Lokasi Observasi</h3>

                <p>
                    Temukan informasi mengenai lokasi pengamatan langit,
                    termasuk alamat dan deskripsi setiap lokasi observasi.
                </p>

                <a href="{{ route('public.lokasi.index') }}" class="info-link">
                    Jelajahi Lokasi →
                </a>
            </div>

            <!-- KEGIATAN -->
            <div class="about-card">
                <div class="card-icon">🔭</div>

                <h3>Kegiatan Observasi</h3>

                <p>
                    Lihat berbagai kegiatan pengamatan astronomi beserta
                    jadwal, target pengamatan, dan lokasi pelaksanaannya.
                </p>

                <a href="{{ route('public.kegiatan.index') }}" class="info-link">
                    Lihat Kegiatan →
                </a>
            </div>

            <!-- PERLENGKAPAN -->
            <div class="about-card">
                <div class="card-icon">🪐</div>

                <h3>Perlengkapan Observasi</h3>

                <p>
                    Kenali perlengkapan yang tersedia untuk menunjang
                    kegiatan pengamatan langit dan astronomi.
                </p>

                <a href="{{ route('public.perlengkapan.index') }}" class="info-link">
                    Lihat Perlengkapan →
                </a>
            </div>

        </div>
    </section>

    <!-- CLOSING -->
    <section class="closing-section">
        <h2>Mulai Perjalanan Menjelajahi Semesta</h2>

        <p>
            Langit malam menyimpan banyak keindahan dan pengetahuan.
            Mari mengenal lebih dekat dunia astronomi melalui informasi
            dan kegiatan yang tersedia di ASTRA.
        </p>

        <a href="{{ route('public.kegiatan.index') }}" class="hero-button">
            Lihat Kegiatan Observasi
        </a>
    </section>

    <!-- FOOTER -->
    <footer class="public-footer">
        <p>
            © {{ date('Y') }} ASTRA. Observatorium Langit Gelap.
            All Rights Reserved.
        </p>
    </footer>

</body>
</html>