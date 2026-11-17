
@extends('layouts.app')

@section('title', 'Kegiatan Observasi')
@section('page-title', 'Kegiatan Observasi')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="page-heading">
    <div>
        <span class="section-eyebrow">CELESTIAL ACTIVITIES</span>
        <h2>Jadwal Pengamatan Langit</h2>
        <p>Kelola agenda, jadwal, dan aktivitas pengamatan langit di berbagai lokasi.</p>
    </div>

    <a href="{{ route('kegiatan.create') }}" class="btn btn-primary">
        + Tambah Kegiatan
    </a>
</div>

{{-- NOTIFIKASI --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- FILTER KEGIATAN --}}
<div class="card activity-filter-card">

    <div class="activity-filter-heading">
        <div class="activity-filter-icon">⌕</div>
        <div>
            <h3>Temukan Kegiatan</h3>
            <p>Gunakan pencarian dan filter untuk menemukan data tertentu.</p>
        </div>
    </div>

    <form action="{{ route('kegiatan.index') }}" method="GET" class="filter-form">

        <div class="form-group">
            <label for="search">Pencarian Kegiatan</label>
            <input
                type="text"
                id="search"
                name="search"
                placeholder="Kode, nama, atau target pengamatan..."
                value="{{ request('search') }}"
            >
        </div>

        <div class="form-group">
            <label for="status">Status Kegiatan</label>
            <select name="status" id="status">
                <option value="">Semua Status</option>

                @foreach ([
                    'direncanakan' => 'Direncanakan',
                    'berlangsung' => 'Berlangsung',
                    'selesai' => 'Selesai',
                    'dibatalkan' => 'Dibatalkan'
                ] as $value => $label)

                    <option
                        value="{{ $value }}"
                        {{ request('status') == $value ? 'selected' : '' }}
                    >
                        {{ $label }}
                    </option>

                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal Observasi</label>
            <input
                type="date"
                id="tanggal"
                name="tanggal"
                value="{{ request('tanggal') }}"
            >
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn btn-primary">
                Cari Data
            </button>

            <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </div>

    </form>
</div>

{{-- DAFTAR KEGIATAN --}}
<div class="card activity-list-card">

    <div class="activity-list-heading">
        <div>
            <span class="section-eyebrow">ACTIVITY RECORDS</span>
            <h3>Daftar Kegiatan Observasi</h3>
            <p>Informasi seluruh kegiatan pengamatan yang telah terdaftar.</p>
        </div>

        <div class="activity-total">
            <strong>{{ $kegiatans->total() }}</strong>
            <span>Total Kegiatan</span>
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode</th>
                    <th>Nama Kegiatan</th>
                    <th>Lokasi</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kegiatans as $index => $kegiatan)
                    <tr>
                        <td>{{ $kegiatans->firstItem() + $index }}</td>

                        <td>
                            <span class="activity-code">
                                {{ $kegiatan->kode_kegiatan }}
                            </span>
                        </td>

                        <td>
                            <strong class="activity-name">
                                {{ $kegiatan->nama_kegiatan }}
                            </strong>
                        </td>

                        <td>
                            <span class="activity-location">
                                ✧ {{ $kegiatan->lokasiObservasi->nama_lokasi ?? '-' }}
                            </span>
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($kegiatan->tanggal_observasi)->format('d M Y') }}
                        </td>

                        <td>
                            <span class="activity-time">
                                {{ $kegiatan->waktu_mulai }} – {{ $kegiatan->waktu_selesai }}
                            </span>
                        </td>

                        <td>
                            <x-status-badge :status="$kegiatan->status" />
                        </td>

                        <td>
                            <div class="action-buttons">
                                <a
                                    href="{{ route('kegiatan.show', $kegiatan->id) }}"
                                    class="btn btn-sm btn-secondary"
                                >
                                    Detail
                                </a>

                                <a
                                    href="{{ route('kegiatan.edit', $kegiatan->id) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('kegiatan.destroy', $kegiatan->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')"
                                    style="display: inline-block;"
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
                        <td colspan="8" class="text-center">
                            Belum ada data kegiatan observasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $kegiatans->links() }}
    </div>

</div>

@endsection
