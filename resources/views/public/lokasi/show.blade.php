
@extends('layouts.app')

@section('title', 'Detail Lokasi Observasi')
@section('page-title', 'Detail Lokasi Observasi')

@section('content')

<div class="page-heading">
    <div>
        <span class="section-eyebrow">OBSERVATION DESTINATION</span>
        <h2>{{ $lokasi->nama_lokasi }}</h2>
        <p>Informasi lengkap lokasi pengamatan langit malam.</p>
    </div>

    <a href="{{ route('public.lokasi.index') }}" class="btn-secondary">
        Kembali ke Daftar Lokasi
    </a>
</div>

<div class="form-card">

    <h3>Informasi Lokasi</h3>

    <div class="detail-info">
        <strong>Nama Lokasi</strong>
        <p>{{ $lokasi->nama_lokasi }}</p>
    </div>

    <div class="detail-info">
        <strong>Alamat</strong>
        <p>{{ $lokasi->alamat ?? 'Belum tersedia' }}</p>
    </div>

    <div class="detail-info">
        <strong>Deskripsi</strong>
        <p>{{ $lokasi->deskripsi ?? 'Belum tersedia' }}</p>
    </div>

</div>

@endsection
