
@extends('layouts.app')

@section('title', 'Perlengkapan Observatorium')
@section('page-title', 'Perlengkapan Observatorium')

@section('content')

<div class="page-heading">
    <div>
        <span class="section-eyebrow">OBSERVATION EQUIPMENT</span>
        <h2>Perlengkapan Observatorium</h2>
        <p>
            Kenali berbagai perlengkapan yang digunakan untuk
            mendukung kegiatan pengamatan langit bersama ASTRA.
        </p>
    </div>
</div>

{{-- FORM PENCARIAN --}}
<div class="form-card" style="margin-bottom: 25px;">
    <form action="{{ route('public.perlengkapan.index') }}" method="GET"
          style="display: flex; gap: 12px; flex-wrap: wrap;">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama, kode, atau kategori perlengkapan..."
            style="flex: 1; min-width: 220px; padding: 13px 16px;
                   border: 1px solid #DCCFE8; border-radius: 10px;
                   font-family: inherit; font-size: 14px;"
        >

        <button type="submit" class="public-location-button"
                style="border: none; cursor: pointer;">
            Cari Perlengkapan
        </button>

        @if(request('search'))
            <a href="{{ route('public.perlengkapan.index') }}"
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

{{-- DAFTAR PERLENGKAPAN --}}
<div class="public-location-grid">

    @forelse ($perlengkapans as $perlengkapan)

        <div class="public-location-card">

            <div class="public-location-content">

                <span class="section-eyebrow">
                    {{ strtoupper($perlengkapan->kategori ?? 'PERLENGKAPAN') }}
                </span>

                <h3>{{ $perlengkapan->nama_perlengkapan }}</h3>

                <p>
                    <strong>Kode:</strong>
                    {{ $perlengkapan->kode_perlengkapan }}
                </p>

                <p>
                    <strong>Kondisi:</strong>
                    {{ ucfirst($perlengkapan->kondisi) }}
                </p>

                <p>
                    <strong>Jumlah:</strong>
                    {{ $perlengkapan->jumlah }}
                    {{ $perlengkapan->satuan }}
                </p>

                <a href="{{ route('public.perlengkapan.show', $perlengkapan->id) }}"
                   class="public-location-button">
                    Lihat Detail
                </a>

            </div>

        </div>

    @empty

        <div class="empty-location">
            <h3>
                {{ request('search') ? 'Perlengkapan Tidak Ditemukan' : 'Belum Ada Perlengkapan Tersedia' }}
            </h3>

            <p>
                {{ request('search')
                    ? 'Coba gunakan kata kunci pencarian yang berbeda.'
                    : 'Informasi perlengkapan observatorium akan ditampilkan setelah tersedia.' }}
            </p>
        </div>

    @endforelse

</div>

@endsection
