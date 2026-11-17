
@extends('layouts.app')

@section('title', 'Lokasi Observasi')
@section('page-title', 'Lokasi Observasi')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="page-heading location-page-heading">
    <div>
        <span class="section-eyebrow">OBSERVATION DESTINATIONS</span>
        <h2>Jelajahi Lokasi Pengamatan</h2>
        <p>Kelola informasi tempat yang digunakan untuk kegiatan pengamatan langit.</p>
    </div>

    <a href="{{ route('lokasi.create') }}" class="btn btn-primary">
        <span>＋</span> Tambah Lokasi
    </a>
</div>

{{-- NOTIFIKASI --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- FILTER DAN PENCARIAN --}}
<div class="card location-filter-card">

    <div class="location-filter-heading">
        <div class="filter-icon">⌕</div>
        <div>
            <h3>Temukan Lokasi</h3>
            <p>Gunakan pencarian atau filter untuk menemukan data lokasi.</p>
        </div>
    </div>

    <form action="{{ route('lokasi.index') }}" method="GET" class="filter-form">

        <div class="form-group">
            <label for="search">Nama atau Alamat Lokasi</label>
            <input
                type="text"
                id="search"
                name="search"
                placeholder="Contoh: Observatorium Bosscha..."
                value="{{ request('search') }}"
            >
        </div>

        <div class="form-group">
            <label for="status">Status Lokasi</label>
            <select name="status" id="status">
                <option value="">Semua Status</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn btn-primary">
                Cari Lokasi
            </button>

            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </div>

    </form>
</div>

{{-- DAFTAR LOKASI --}}
<div class="card location-list-card">

    <div class="card-header location-list-header">
        <div>
            <span class="section-eyebrow">REGISTERED DESTINATIONS</span>
            <h3>Daftar Lokasi Observasi</h3>
            <p>Menampilkan {{ $lokasis->total() }} lokasi yang tersimpan dalam sistem.</p>
        </div>

        <div class="location-total">
            <strong>{{ $lokasis->total() }}</strong>
            <span>Total Lokasi</span>
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Lokasi</th>
                    <th>Alamat</th>
                    <th>Tingkat Kegelapan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($lokasis as $index => $lokasi)
                    <tr>
                        <td>{{ $lokasis->firstItem() + $index }}</td>

                        <td>
                            <div class="location-name-cell">
                                <span class="location-row-icon">✦</span>
                                <strong>{{ $lokasi->nama_lokasi }}</strong>
                            </div>
                        </td>

                        <td>{{ $lokasi->alamat }}</td>

                        <td>
                            <span class="darkness-label">
                                {{ $lokasi->tingkat_kegelapan }}
                            </span>
                        </td>

                        <td>
                            <x-status-badge :status="$lokasi->status" />
                        </td>

                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('lokasi.show', $lokasi->id) }}"
                                   class="btn btn-sm btn-secondary">
                                    Detail
                                </a>

                                <a href="{{ route('lokasi.edit', $lokasi->id) }}"
                                   class="btn btn-sm btn-primary">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('lokasi.destroy', $lokasi->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data lokasi observasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $lokasis->links() }}
    </div>

</div>

@endsection
