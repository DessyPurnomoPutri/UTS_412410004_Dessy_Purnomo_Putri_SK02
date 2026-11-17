
@extends('layouts.app')

@section('title', 'Detail Perlengkapan')
@section('page-title', 'Detail Perlengkapan')

@section('content')

<div class="page-heading">
    <div>
        <span class="section-eyebrow">OBSERVATION EQUIPMENT</span>
        <h2>{{ $perlengkapan->nama_perlengkapan }}</h2>
        <p>Informasi lengkap perlengkapan observatorium ASTRA.</p>
    </div>

    <a href="{{ route('public.perlengkapan.index') }}" class="btn-secondary">
        Kembali ke Daftar Perlengkapan
    </a>
</div>

<div class="form-card">

    <h3>Informasi Perlengkapan</h3>

    <div class="detail-info">
        <strong>Kode Perlengkapan</strong>
        <p>{{ $perlengkapan->kode_perlengkapan }}</p>
    </div>

    <div class="detail-info">
        <strong>Nama Perlengkapan</strong>
        <p>{{ $perlengkapan->nama_perlengkapan }}</p>
    </div>

    <div class="detail-info">
        <strong>Kategori</strong>
        <p>{{ ucfirst($perlengkapan->kategori ?? 'Belum tersedia') }}</p>
    </div>

    <div class="detail-info">
        <strong>Kondisi</strong>
        <p>{{ ucfirst($perlengkapan->kondisi ?? 'Belum tersedia') }}</p>
    </div>

    <div class="detail-info">
        <strong>Jumlah</strong>
        <p>
            {{ $perlengkapan->jumlah }}
            {{ $perlengkapan->satuan }}
        </p>
    </div>

    <div class="detail-info">
        <strong>Keterangan</strong>
        <p>{{ $perlengkapan->keterangan ?? 'Belum tersedia' }}</p>
    </div>

</div>

@endsection
