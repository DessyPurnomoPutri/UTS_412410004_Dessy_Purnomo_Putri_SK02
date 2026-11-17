
@extends('layouts.app')

@section('title', 'Data Peserta')
@section('page-title', 'Data Peserta')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="page-heading">
    <div>
        <span class="section-eyebrow">OBSERVATION PARTICIPANTS</span>
        <h2>Data Peserta Observasi</h2>
        <p>Kelola informasi peserta yang mengikuti kegiatan pengamatan langit.</p>
    </div>

    <a href="{{ route('peserta.create') }}" class="btn btn-primary">
        + Tambah Peserta
    </a>
</div>

{{-- NOTIFIKASI --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- PENCARIAN --}}
<div class="card participant-filter-card">
    <form action="{{ route('peserta.index') }}" method="GET" class="participant-filter-form">

        <div class="filter-search-group">
            <label for="search">Cari Peserta</label>

            <div class="participant-search-input">
                <span>⌕</span>
                <input
                    type="text"
                    id="search"
                    name="search"
                    placeholder="Cari nama, email, atau instansi..."
                    value="{{ request('search') }}"
                >
            </div>
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn btn-primary">
                Cari Peserta
            </button>

            <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </div>

    </form>
</div>

{{-- DAFTAR PESERTA --}}
<div class="card participant-table-card">

    <div class="card-header participant-table-header">
        <div>
            <span class="section-eyebrow">PARTICIPANT DIRECTORY</span>
            <h3>Daftar Peserta</h3>
            <p>Menampilkan {{ $pesertas->total() }} data peserta terdaftar.</p>
        </div>

        <div class="participant-total">
            <span>♧</span>
            {{ $pesertas->total() }} Peserta
        </div>
    </div>

    <div class="table-wrapper">
        <table class="participant-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Instansi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pesertas as $index => $peserta)
                    <tr>
                        <td class="participant-number">
                            {{ $pesertas->firstItem() + $index }}
                        </td>

                        <td>
                            <div class="participant-name-cell">
                                <div class="participant-avatar">
                                    {{ strtoupper(substr($peserta->nama_peserta, 0, 1)) }}
                                </div>

                                <strong>{{ $peserta->nama_peserta }}</strong>
                            </div>
                        </td>

                        <td>{{ $peserta->email }}</td>

                        <td>{{ $peserta->no_telepon ?? '-' }}</td>

                        <td>
                            <span class="participant-institution">
                                {{ $peserta->instansi ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <div class="action-buttons">

                                <a
                                    href="{{ route('peserta.show', $peserta->id) }}"
                                    class="btn btn-sm btn-secondary"
                                >
                                    Detail
                                </a>

                                <a
                                    href="{{ route('peserta.edit', $peserta->id) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('peserta.destroy', $peserta->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')"
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
                        <td colspan="6">
                            <div class="participant-empty">
                                <span>☾</span>
                                <strong>Belum Ada Data Peserta</strong>
                                <p>Data peserta observasi belum tersedia.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $pesertas->links() }}
    </div>

</div>

@endsection
