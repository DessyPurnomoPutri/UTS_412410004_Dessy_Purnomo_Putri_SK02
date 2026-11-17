
@extends('layouts.app')

@section('title', 'Detail Perlengkapan')
@section('page-title', 'Detail Perlengkapan')

@section('content')

<div class="page-heading equipment-detail-heading">
    <div>
        <span class="eyebrow">INVENTARIS OBSERVATORIUM</span>
        <h2>Detail Perlengkapan</h2>
        <p>Informasi lengkap mengenai perlengkapan dan riwayat penggunaannya.</p>
    </div>

    <div class="header-actions">
        <a href="{{ route('perlengkapan.edit', $perlengkapan->id) }}" class="btn btn-primary">
            Edit Perlengkapan
        </a>

        <a href="{{ route('perlengkapan.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>

<div class="equipment-detail-grid">

    {{-- Informasi Perlengkapan --}}
    <div class="card equipment-detail-card">
        <div class="card-header">
            <div>
                <span class="equipment-card-label">DATA INVENTARIS</span>
                <h3>Informasi Perlengkapan</h3>
            </div>
            <span class="equipment-card-icon">✦</span>
        </div>

        <div class="detail-list">
            <div class="detail-row">
                <span>Kode Perlengkapan</span>
                <strong>{{ $perlengkapan->kode_perlengkapan }}</strong>
            </div>

            <div class="detail-row">
                <span>Nama Perlengkapan</span>
                <strong>{{ $perlengkapan->nama_perlengkapan }}</strong>
            </div>

            <div class="detail-row">
                <span>Kategori</span>
                <strong>{{ $perlengkapan->kategori }}</strong>
            </div>

            <div class="detail-row">
                <span>Kondisi</span>
                <strong>
                    <x-status-badge :status="$perlengkapan->kondisi" />
                </strong>
            </div>

            <div class="detail-row">
                <span>Jumlah Tersedia</span>
                <strong>{{ $perlengkapan->jumlah }} {{ $perlengkapan->satuan }}</strong>
            </div>

            <div class="detail-row detail-row-description">
                <span>Keterangan</span>
                <strong>{{ $perlengkapan->keterangan ?: '-' }}</strong>
            </div>
        </div>
    </div>

    {{-- Riwayat Penggunaan --}}
    <div class="card equipment-detail-card">
        <div class="card-header">
            <div>
                <span class="equipment-card-label">AKTIVITAS</span>
                <h3>Riwayat Penggunaan</h3>
            </div>
            <span class="equipment-card-icon">☾</span>
        </div>

        <div class="equipment-history">
            @forelse ($perlengkapan->kegiatans as $kegiatan)
                <div class="equipment-history-item">
                    <div class="equipment-history-marker"></div>

                    <div class="equipment-history-content">
                        <strong>{{ $kegiatan->nama_kegiatan }}</strong>

                        <span class="equipment-history-code">
                            {{ $kegiatan->kode_kegiatan }}
                        </span>

                        <div class="equipment-history-info">
                            <p>
                                <span>Jumlah digunakan</span>
                                <strong>
                                    {{ $kegiatan->pivot->jumlah_digunakan }}
                                    {{ $perlengkapan->satuan }}
                                </strong>
                            </p>

                            <p>
                                <span>Catatan</span>
                                <strong>{{ $kegiatan->pivot->catatan ?: '-' }}</strong>
                            </p>
                        </div>

                        <a href="{{ route('kegiatan.show', $kegiatan->id) }}"
                           class="equipment-history-link">
                            Lihat detail kegiatan →
                        </a>
                    </div>
                </div>
            @empty
                <div class="equipment-history-empty">
                    <span>☾</span>
                    <strong>Belum Ada Riwayat Penggunaan</strong>
                    <p>Perlengkapan ini belum digunakan dalam kegiatan observasi.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
