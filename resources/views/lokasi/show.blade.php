
@extends('layouts.app')

@section('title', 'Detail Lokasi Observasi')
@section('page-title', 'Detail Lokasi')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="page-heading">
    <div>
        <span class="section-eyebrow">OBSERVATION DESTINATION</span>
        <h2>Informasi Lokasi Pengamatan</h2>
        <p>Kenali lebih jauh karakteristik dan riwayat kegiatan di lokasi observasi ini.</p>
    </div>

    <div class="action-buttons">
        <a href="{{ route('lokasi.edit', $lokasi->id) }}" class="btn btn-primary">
            ✎ Edit Lokasi
        </a>

        <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">
            ← Kembali
        </a>
    </div>
</div>

{{-- IDENTITAS LOKASI --}}
<div class="location-detail-hero">
    <div class="location-detail-symbol">✦</div>

    <div class="location-detail-intro">
        <span class="detail-eyebrow">OBSERVATION LOCATION</span>
        <h2>{{ $lokasi->nama_lokasi }}</h2>
        <p>{{ $lokasi->alamat }}</p>
    </div>

    <div class="location-detail-status">
        <x-status-badge :status="$lokasi->status" />
    </div>
</div>

{{-- RINGKASAN --}}
<div class="location-overview-grid">

    <div class="location-overview-card">
        <span class="overview-icon">✧</span>
        <div>
            <small>Tingkat Kegelapan</small>
            <strong>{{ $lokasi->tingkat_kegelapan }}</strong>
        </div>
    </div>

    <div class="location-overview-card">
        <span class="overview-icon">☾</span>
        <div>
            <small>Kegiatan Observasi</small>
            <strong>{{ $lokasi->kegiatans->count() }} Kegiatan</strong>
        </div>
    </div>

    <div class="location-overview-card">
        <span class="overview-icon">⌖</span>
        <div>
            <small>Koordinat Geografis</small>
            <strong>
                {{ $lokasi->latitude !== null && $lokasi->longitude !== null ? 'Tersedia' : 'Belum tersedia' }}
            </strong>
        </div>
    </div>

</div>

{{-- DETAIL INFORMASI --}}
<div class="card location-detail-card">

    <div class="detail-card-heading">
        <div>
            <span class="section-eyebrow">LOCATION INFORMATION</span>
            <h3>Detail Informasi Lokasi</h3>
            <p>Informasi lengkap mengenai tempat pengamatan langit.</p>
        </div>

        <span class="detail-heading-icon">✧</span>
    </div>

    <div class="detail-grid">

        <div class="detail-item">
            <span>Nama Lokasi</span>
            <strong>{{ $lokasi->nama_lokasi }}</strong>
        </div>

        <div class="detail-item">
            <span>Status Lokasi</span>
            <strong>
                <x-status-badge :status="$lokasi->status" />
            </strong>
        </div>

        <div class="detail-item detail-item-full">
            <span>Alamat Lengkap</span>
            <strong>{{ $lokasi->alamat }}</strong>
        </div>

        <div class="detail-item">
            <span>Tingkat Kegelapan Langit</span>
            <strong>{{ $lokasi->tingkat_kegelapan }}</strong>
        </div>

        <div class="detail-item">
            <span>Tanggal Dibuat</span>
            <strong>{{ $lokasi->created_at->format('d M Y') }}</strong>
        </div>

        <div class="detail-item">
            <span>Latitude</span>
            <strong>{{ $lokasi->latitude ?? 'Belum tersedia' }}</strong>
        </div>

        <div class="detail-item">
            <span>Longitude</span>
            <strong>{{ $lokasi->longitude ?? 'Belum tersedia' }}</strong>
        </div>

    </div>

    <div class="detail-description">
        <span>Deskripsi Lokasi</span>
        <p>{{ $lokasi->deskripsi ?: 'Belum ada deskripsi lokasi.' }}</p>
    </div>

</div>

{{-- RIWAYAT KEGIATAN --}}
<div class="card location-history-card">

    <div class="detail-card-heading">
        <div>
            <span class="section-eyebrow">OBSERVATION HISTORY</span>
            <h3>Riwayat Kegiatan Observasi</h3>
            <p>Daftar kegiatan yang pernah atau akan dilaksanakan di lokasi ini.</p>
        </div>

        <span class="history-count">
            {{ $lokasi->kegiatans->count() }} Data
        </span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Kegiatan</th>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal Observasi</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($lokasi->kegiatans as $index => $kegiatan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <span class="activity-code">
                                {{ $kegiatan->kode_kegiatan }}
                            </span>
                        </td>
                        <td>{{ $kegiatan->nama_kegiatan }}</td>
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
                            Belum ada kegiatan observasi di lokasi ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection