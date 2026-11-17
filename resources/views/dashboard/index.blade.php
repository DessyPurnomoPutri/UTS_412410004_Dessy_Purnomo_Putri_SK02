
@extends('layouts.app')

@section('title', 'Dashboard - Observatorium Langit Gelap')
@section('page-title', 'Dashboard')

@section('content')

{{-- HERO SECTION --}}
<div class="dashboard-hero">
    <div class="hero-decoration hero-decoration-one"></div>
    <div class="hero-decoration hero-decoration-two"></div>

    <div class="hero-content">
        <span class="hero-label">✦ YOUR WINDOW TO THE UNIVERSE</span>

        <h2>
            Selamat Datang di
            <span>Observatorium Langit Gelap.</span>
        </h2>

        <p>
            Pusat pengelolaan aktivitas observasi astronomi.
            Pantau lokasi, kegiatan, peserta, dan perlengkapan
            untuk mendukung pengalaman pengamatan langit yang lebih terorganisir.
        </p>

        <a href="{{ route('kegiatan.index') }}" class="hero-button">
            Jelajahi Kegiatan
            <span>↗</span>
        </a>
    </div>

    <div class="hero-illustration">
        <div class="orbit orbit-one"></div>
        <div class="orbit orbit-two"></div>

        <div class="orbit-center">
            <span>☾</span>
        </div>

        <span class="hero-star star-one">✦</span>
        <span class="hero-star star-two">✧</span>
        <span class="hero-star star-three">·</span>
        <span class="hero-star star-four">✦</span>
    </div>
</div>


{{-- RINGKASAN DATA --}}
<div class="dashboard-section-heading">
    <div>
        <span class="section-eyebrow">OBSERVATORY OVERVIEW</span>
        <h2>Ringkasan Observatorium</h2>
        <p>Informasi keseluruhan data yang tersimpan dalam sistem.</p>
    </div>
</div>

<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-icon">⌖</div>
        <div class="stat-info">
            <p>Total Lokasi Observasi</p>
            <h3>{{ $totalLokasi }}</h3>
            <span class="stat-caption">Lokasi pengamatan terdaftar</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">✦</div>
        <div class="stat-info">
            <p>Total Kegiatan</p>
            <h3>{{ $totalKegiatan }}</h3>
            <span class="stat-caption">Kegiatan observasi tercatat</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">♙</div>
        <div class="stat-info">
            <p>Total Peserta</p>
            <h3>{{ $totalPeserta }}</h3>
            <span class="stat-caption">Peserta terdaftar</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">⌕</div>
        <div class="stat-info">
            <p>Total Perlengkapan</p>
            <h3>{{ $totalPerlengkapan }}</h3>
            <span class="stat-caption">Perlengkapan observasi</span>
        </div>
    </div>

</div>


{{-- KEGIATAN TERBARU --}}
<div class="dashboard-section-heading section-heading-spaced">
    <div>
        <span class="section-eyebrow">LATEST ACTIVITIES</span>
        <h2>Jejak Pengamatan Terbaru</h2>
        <p>Daftar kegiatan observasi yang terakhir ditambahkan ke sistem.</p>
    </div>

    <a href="{{ route('kegiatan.index') }}" class="section-link">
        Lihat Semua Kegiatan <span>↗</span>
    </a>
</div>

<div class="card dashboard-table-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Kode Kegiatan</th>
                    <th>Nama Kegiatan</th>
                    <th>Lokasi Pengamatan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kegiatanTerbaru as $kegiatan)
                    <tr>
                        <td>
                            <strong>{{ $kegiatan->kode_kegiatan }}</strong>
                        </td>

                        <td>{{ $kegiatan->nama_kegiatan }}</td>

                        <td>
                            {{ $kegiatan->lokasiObservasi->nama_lokasi ?? '-' }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($kegiatan->tanggal_observasi)->format('d M Y') }}
                        </td>

                        <td>
                            <x-status-badge :status="$kegiatan->status" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Belum ada kegiatan observasi yang tercatat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


{{-- AGENDA MENDATANG --}}
<div class="dashboard-section-heading section-heading-spaced">
    <div>
        <span class="section-eyebrow">UPCOMING OBSERVATIONS</span>
        <h2>Agenda Pengamatan Mendatang</h2>
        <p>Jadwal kegiatan observasi yang direncanakan untuk dilaksanakan.</p>
    </div>
</div>

<div class="card dashboard-table-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Lokasi Pengamatan</th>
                    <th>Tanggal</th>
                    <th>Waktu Pengamatan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kegiatanMendatang as $kegiatan)
                    <tr>
                        <td>
                            <strong>{{ $kegiatan->nama_kegiatan }}</strong>
                        </td>

                        <td>
                            {{ $kegiatan->lokasiObservasi->nama_lokasi ?? '-' }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($kegiatan->tanggal_observasi)->format('d M Y') }}
                        </td>

                        <td>
                            {{ $kegiatan->waktu_mulai }} - {{ $kegiatan->waktu_selesai }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            Belum ada agenda pengamatan mendatang.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
