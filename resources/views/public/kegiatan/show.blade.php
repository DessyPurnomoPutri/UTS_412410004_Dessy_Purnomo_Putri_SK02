
@extends('layouts.app')

@section('title', 'Detail Kegiatan Observasi')
@section('page-title', 'Detail Kegiatan Observasi')

@section('content')

<div class="page-heading">
    <div>
        <span class="section-eyebrow">CELESTIAL ACTIVITIES</span>
        <h2>{{ $kegiatan->nama_kegiatan }}</h2>
        <p>Informasi lengkap kegiatan pengamatan langit bersama ASTRA.</p>
    </div>

    <a href="{{ route('public.kegiatan.index') }}" class="btn-secondary">
        Kembali ke Daftar Kegiatan
    </a>
</div>

<div class="form-card">

    <h3>Informasi Kegiatan</h3>

    <div class="detail-info">
        <strong>Kode Kegiatan</strong>
        <p>{{ $kegiatan->kode_kegiatan ?? 'Belum tersedia' }}</p>
    </div>

    <div class="detail-info">
        <strong>Nama Kegiatan</strong>
        <p>{{ $kegiatan->nama_kegiatan }}</p>
    </div>

    <div class="detail-info">
        <strong>Lokasi Observasi</strong>
        <p>{{ $kegiatan->lokasi->nama_lokasi ?? 'Belum ditentukan' }}</p>
    </div>

    <div class="detail-info">
        <strong>Tanggal Observasi</strong>
        <p>
            {{ $kegiatan->tanggal_observasi
                ? \Carbon\Carbon::parse($kegiatan->tanggal_observasi)->format('d F Y')
                : 'Belum ditentukan' }}
        </p>
    </div>

    <div class="detail-info">
        <strong>Waktu Observasi</strong>
        <p>
            {{ $kegiatan->waktu_mulai ?? '-' }}
            sampai
            {{ $kegiatan->waktu_selesai ?? '-' }}
        </p>
    </div>

    <div class="detail-info">
        <strong>Target Pengamatan</strong>
        <p>{{ $kegiatan->target_pengamatan ?? 'Belum tersedia' }}</p>
    </div>

    <div class="detail-info">
        <strong>Status Kegiatan</strong>
        <p>{{ ucfirst($kegiatan->status ?? 'Belum tersedia') }}</p>
    </div>

    <div class="detail-info">
        <strong>Deskripsi Kegiatan</strong>
        <p>{{ $kegiatan->deskripsi ?? 'Belum tersedia' }}</p>
    </div>

</div>

@endsection
