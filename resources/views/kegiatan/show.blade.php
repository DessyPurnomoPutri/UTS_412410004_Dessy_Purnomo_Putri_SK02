
@extends('layouts.app')

@section('title', 'Detail Kegiatan Observasi')
@section('page-title', 'Detail Kegiatan')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="page-heading">
    <div>
        <span class="section-eyebrow">OBSERVATION ACTIVITY DETAILS</span>
        <h2>Detail Kegiatan Observasi</h2>
        <p>Informasi lengkap mengenai kegiatan pengamatan langit yang telah terdaftar.</p>
    </div>

    <div class="header-actions">
        <a href="{{ route('kegiatan.edit', $data->id) }}" class="btn btn-primary">
            ✎ Edit Kegiatan
        </a>

        <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">
            ← Kembali
        </a>
    </div>
</div>

{{-- RINGKASAN KEGIATAN --}}
<div class="card activity-overview-card">
    <div class="activity-overview-icon">☾</div>

    <div class="activity-overview-content">
        <span class="activity-overview-label">
            {{ $data->kode_kegiatan }}
        </span>

        <h3>{{ $data->nama_kegiatan }}</h3>

        <p>
            <span>⌖</span>
            {{ $data->lokasi->nama_lokasi ?? 'Lokasi belum ditentukan' }}
        </p>
    </div>

    <div class="activity-overview-status">
        <span class="overview-status-label">Status Kegiatan</span>
        <x-status-badge :status="$data->status" />
    </div>
</div>

{{-- INFORMASI UTAMA --}}
<div class="card activity-detail-card">
    <div class="activity-detail-heading">
        <div class="detail-heading-icon">✧</div>
        <div>
            <h3>Informasi Kegiatan</h3>
            <p>Identitas dan jadwal pelaksanaan observasi.</p>
        </div>
    </div>

    <div class="activity-detail-grid">

        <div class="activity-detail-item">
            <span>Kode Kegiatan</span>
            <strong>{{ $data->kode_kegiatan }}</strong>
        </div>

        <div class="activity-detail-item">
            <span>Nama Kegiatan</span>
            <strong>{{ $data->nama_kegiatan }}</strong>
        </div>

        <div class="activity-detail-item">
            <span>Lokasi Observasi</span>
            <strong>{{ $data->lokasi->nama_lokasi ?? '-' }}</strong>
        </div>

        <div class="activity-detail-item">
            <span>Tanggal Observasi</span>
            <strong>
                {{ \Carbon\Carbon::parse($data->tanggal_observasi)->translatedFormat('d F Y') }}
            </strong>
        </div>

        <div class="activity-detail-item">
            <span>Waktu Mulai</span>
            <strong>
                {{ \Carbon\Carbon::parse($data->waktu_mulai)->format('H:i') }} WIB
            </strong>
        </div>

        <div class="activity-detail-item">
            <span>Waktu Selesai</span>
            <strong>
                {{ \Carbon\Carbon::parse($data->waktu_selesai)->format('H:i') }} WIB
            </strong>
        </div>

        <div class="activity-detail-item">
            <span>Target Pengamatan</span>
            <strong>{{ $data->target_pengamatan }}</strong>
        </div>

        <div class="activity-detail-item activity-detail-description">
            <span>Deskripsi Kegiatan</span>
            <strong>{{ $data->deskripsi ?: 'Tidak ada deskripsi kegiatan.' }}</strong>
        </div>

    </div>
</div>

{{-- PESERTA DAN PERLENGKAPAN --}}
<div class="activity-detail-columns">

    {{-- PESERTA --}}
    <div class="card activity-detail-card">
        <div class="activity-detail-heading">
            <div class="detail-heading-icon">♧</div>
            <div>
                <h3>Peserta Kegiatan</h3>
                <p>Daftar peserta yang mengikuti observasi.</p>
            </div>

            <span class="detail-count">
                {{ $data->pesertas->count() }} Peserta
            </span>
        </div>

        <div class="activity-detail-list">
            @forelse ($data->pesertas as $peserta)
                <div class="activity-person-item">
                    <div class="person-avatar">
                        {{ strtoupper(substr($peserta->nama_peserta, 0, 1)) }}
                    </div>

                    <div class="person-information">
                        <strong>{{ $peserta->nama_peserta }}</strong>
                        <small>{{ $peserta->email }}</small>
                    </div>

                    <div class="person-status">
                        <x-status-badge :status="$peserta->pivot->status_keikutsertaan" />
                    </div>
                </div>
            @empty
                <div class="activity-detail-empty">
                    <span>☾</span>
                    <p>Belum ada peserta yang terdaftar pada kegiatan ini.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- PERLENGKAPAN --}}
    <div class="card activity-detail-card">
        <div class="activity-detail-heading">
            <div class="detail-heading-icon">✧</div>
            <div>
                <h3>Perlengkapan Observasi</h3>
                <p>Daftar perlengkapan yang digunakan.</p>
            </div>

            <span class="detail-count">
                {{ $data->perlengkapans->count() }} Jenis
            </span>
        </div>

        <div class="activity-detail-list">
            @forelse ($data->perlengkapans as $perlengkapan)
                <div class="activity-equipment-detail">
                    <div class="equipment-detail-icon">⌕</div>

                    <div class="equipment-detail-information">
                        <strong>{{ $perlengkapan->nama_perlengkapan }}</strong>

                        <small>
                            {{ $perlengkapan->kode_perlengkapan }}
                        </small>

                        <p>
                            Jumlah digunakan:
                            <strong>
                                {{ $perlengkapan->pivot->jumlah_digunakan }}
                                {{ $perlengkapan->satuan }}
                            </strong>
                        </p>

                        @if ($perlengkapan->pivot->catatan)
                            <small class="equipment-detail-note">
                                Catatan: {{ $perlengkapan->pivot->catatan }}
                            </small>
                        @endif
                    </div>
                </div>
            @empty
                <div class="activity-detail-empty">
                    <span>☾</span>
                    <p>Belum ada perlengkapan yang digunakan.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
