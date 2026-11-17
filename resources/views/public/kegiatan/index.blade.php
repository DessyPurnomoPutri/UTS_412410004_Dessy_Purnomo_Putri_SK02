
@extends('layouts.app')

@section('title', 'Kegiatan Observasi')
@section('page-title', 'Kegiatan Observasi')

@section('content')

<div class="page-heading">
    <div>
        <span class="section-eyebrow">CELESTIAL ACTIVITIES</span>
        <h2>Kegiatan Observasi Langit</h2>
        <p>
            Temukan berbagai kegiatan pengamatan langit malam
            dan jelajahi pengalaman astronomi bersama ASTRA.
        </p>
    </div>
</div>

{{-- FORM PENCARIAN --}}
<div class="form-card" style="margin-bottom: 25px;">
    <form action="{{ route('public.kegiatan.index') }}" method="GET"
          style="display: flex; gap: 12px; flex-wrap: wrap;">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama kegiatan, target, atau lokasi..."
            style="flex: 1; min-width: 220px; padding: 13px 16px;
                   border: 1px solid #DCCFE8; border-radius: 10px;
                   font-family: inherit; font-size: 14px;"
        >

        <button type="submit" class="public-location-button"
                style="border: none; cursor: pointer;">
            Cari Kegiatan
        </button>

        @if(request('search'))
            <a href="{{ route('public.kegiatan.index') }}"
               class="btn-secondary"
               style="padding: 12px 18px; border-radius: 10px;
                      display: inline-flex; align-items: center;">
                Reset
            </a>
        @endif
    </form>
</div>

@if(request('search'))
    <p style="margin-bottom: 20px; color: #897E90;">
        Hasil pencarian untuk:
        <strong>{{ request('search') }}</strong>
    </p>
@endif

{{-- DAFTAR KEGIATAN --}}
<div class="public-location-grid">

    @forelse ($kegiatans as $kegiatan)

        <div class="public-location-card">

            <div class="public-location-content">

                <span class="section-eyebrow">
                    {{ strtoupper($kegiatan->status ?? 'KEGIATAN OBSERVASI') }}
                </span>

                <h3>{{ $kegiatan->nama_kegiatan }}</h3>

                <p>
                    <strong>Tanggal:</strong>
                    {{ $kegiatan->tanggal_observasi
                        ? \Carbon\Carbon::parse($kegiatan->tanggal_observasi)->format('d F Y')
                        : 'Belum ditentukan' }}
                </p>

                <p>
                    <strong>Waktu:</strong>
                    {{ $kegiatan->waktu_mulai ?? '-' }}
                    -
                    {{ $kegiatan->waktu_selesai ?? '-' }}
                </p>

                <p>
                    <strong>Lokasi:</strong>
                    {{ $kegiatan->lokasi->nama_lokasi ?? 'Belum ditentukan' }}
                </p>

                <a href="{{ route('public.kegiatan.show', $kegiatan->id) }}"
                   class="public-location-button">
                    Lihat Detail
                </a>

            </div>

        </div>

    @empty

        <div class="empty-location">
            <h3>
                {{ request('search') ? 'Kegiatan Tidak Ditemukan' : 'Belum Ada Kegiatan Observasi' }}
            </h3>

            <p>
                {{ request('search')
                    ? 'Coba gunakan kata kunci pencarian yang berbeda.'
                    : 'Informasi kegiatan observasi akan ditampilkan setelah tersedia.' }}
            </p>
        </div>

    @endforelse

</div>

@endsection
