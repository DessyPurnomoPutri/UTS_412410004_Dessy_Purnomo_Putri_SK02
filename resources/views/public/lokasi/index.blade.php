
@extends('layouts.app')

@section('title', 'Lokasi Observasi')
@section('page-title', 'Lokasi Observasi')

@section('content')

<div class="page-heading">
    <div>
        <span class="section-eyebrow">OBSERVATION DESTINATIONS</span>
        <h2>Jelajahi Lokasi Observasi</h2>
        <p>Temukan berbagai lokasi pengamatan langit gelap untuk menikmati keindahan langit malam.</p>
    </div>
</div>

{{-- FORM PENCARIAN --}}
<div class="form-card" style="margin-bottom: 25px;">
    <form action="{{ route('public.lokasi.index') }}" method="GET"
          style="display: flex; gap: 12px; flex-wrap: wrap;">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama lokasi atau alamat..."
            style="flex: 1; min-width: 220px; padding: 13px 16px;
                   border: 1px solid #DCCFE8; border-radius: 10px;
                   font-family: inherit; font-size: 14px;"
        >

        <button type="submit" class="public-location-button"
                style="border: none; cursor: pointer;">
            Cari Lokasi
        </button>

        @if(request('search'))
            <a href="{{ route('public.lokasi.index') }}"
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

{{-- DAFTAR LOKASI --}}
<div class="public-location-grid">

    @forelse ($lokasis as $lokasi)
        <div class="public-location-card">

            <div class="public-location-content">
                <span class="section-eyebrow">OBSERVATION LOCATION</span>

                <h3>{{ $lokasi->nama_lokasi }}</h3>

                <p>
                    {{ $lokasi->alamat ?? 'Informasi alamat belum tersedia.' }}
                </p>

                <a href="{{ route('public.lokasi.show', $lokasi->id) }}"
                   class="public-location-button">
                    Lihat Detail
                </a>
            </div>

        </div>
    @empty
        <div class="empty-location">
            <h3>
                {{ request('search') ? 'Lokasi Tidak Ditemukan' : 'Belum Ada Lokasi Observasi' }}
            </h3>

            <p>
                {{ request('search')
                    ? 'Coba gunakan kata kunci pencarian yang berbeda.'
                    : 'Informasi lokasi observasi akan ditampilkan di halaman ini.' }}
            </p>
        </div>
    @endforelse

</div>

@endsection
