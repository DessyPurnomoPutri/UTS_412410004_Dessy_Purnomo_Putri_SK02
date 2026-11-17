
@extends('layouts.app')

@section('title', 'Detail Peserta')
@section('page-title', 'Detail Peserta')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="page-heading">
    <div>
        <span class="section-eyebrow">PARTICIPANT PROFILE</span>
        <h2>Detail Peserta</h2>
        <p>Informasi lengkap peserta yang terdaftar dalam sistem observatorium.</p>
    </div>

    <div class="header-actions">
        <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
            ← Kembali
        </a>

        <a href="{{ route('peserta.edit', $peserta->id) }}" class="btn btn-primary">
            ✎ Edit Peserta
        </a>
    </div>
</div>

<div class="participant-detail-grid">

    {{-- INFORMASI PESERTA --}}
    <div class="card participant-detail-card">

        <div class="participant-detail-header">
            <div class="participant-detail-icon">♙</div>

            <div>
                <span class="section-eyebrow">PERSONAL INFORMATION</span>
                <h3>Informasi Peserta</h3>
                <p>Data identitas dan kontak peserta observasi.</p>
            </div>
        </div>

        <div class="participant-profile">
            <div class="participant-avatar">
                {{ strtoupper(substr($peserta->nama_peserta, 0, 1)) }}
            </div>

            <div>
                <h4>{{ $peserta->nama_peserta }}</h4>
                <p>{{ $peserta->instansi ?? 'Instansi tidak dicantumkan' }}</p>
            </div>
        </div>

        <div class="participant-detail-list">

            <div class="participant-detail-row">
                <span>Nama Lengkap</span>
                <strong>{{ $peserta->nama_peserta }}</strong>
            </div>

            <div class="participant-detail-row">
                <span>Email</span>
                <strong>{{ $peserta->email }}</strong>
            </div>

            <div class="participant-detail-row">
                <span>Nomor Telepon</span>
                <strong>{{ $peserta->no_telepon ?: '-' }}</strong>
            </div>

            <div class="participant-detail-row">
                <span>Instansi</span>
                <strong>{{ $peserta->instansi ?: '-' }}</strong>
            </div>

            <div class="participant-detail-row participant-address-row">
                <span>Alamat</span>
                <strong>{{ $peserta->alamat ?: '-' }}</strong>
            </div>

        </div>
    </div>

    {{-- RIWAYAT KEGIATAN --}}
    <div class="card participant-history-card">

        <div class="participant-detail-header">
            <div class="participant-detail-icon history-icon">✧</div>

            <div>
                <span class="section-eyebrow">OBSERVATION HISTORY</span>
                <h3>Riwayat Kegiatan</h3>
                <p>Daftar kegiatan observasi yang diikuti peserta.</p>
            </div>
        </div>

        <div class="history-count">
            <span>Total kegiatan diikuti</span>
            <strong>{{ $peserta->kegiatans->count() }}</strong>
        </div>

        <div class="participant-history-list">

            @forelse ($peserta->kegiatans as $kegiatan)

                <div class="participant-history-item">

                    <div class="history-timeline-dot"></div>

                    <div class="history-item-content">

                        <h4>{{ $kegiatan->nama_kegiatan }}</h4>

                        <div class="history-item-meta">
                            <span>
                                <strong>Kode:</strong>
                                {{ $kegiatan->kode_kegiatan }}
                            </span>

                            <span>
                                <strong>Tanggal:</strong>
                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_observasi)->format('d M Y') }}
                            </span>
                        </div>

                        <div class="history-item-footer">
                            <x-status-badge :status="$kegiatan->status" />

                            <a
                                href="{{ route('kegiatan.show', $kegiatan->id) }}"
                                class="btn btn-sm btn-secondary"
                            >
                                Lihat Kegiatan →
                            </a>
                        </div>

                    </div>
                </div>

            @empty

                <div class="participant-history-empty">
                    <div class="empty-history-icon">☾</div>
                    <h4>Belum Ada Riwayat Kegiatan</h4>
                    <p>Peserta ini belum terdaftar dalam kegiatan observasi apa pun.</p>
                </div>

            @endforelse

        </div>
    </div>

</div>

@endsection
