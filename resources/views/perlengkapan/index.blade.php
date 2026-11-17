
@extends('layouts.app')

@section('title', 'Data Perlengkapan')
@section('page-title', 'Data Perlengkapan')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="page-heading">
    <div>
        <span class="section-eyebrow">OBSERVATION EQUIPMENT</span>
        <h2>Perlengkapan Observasi</h2>
        <p>Kelola inventaris peralatan yang digunakan dalam kegiatan pengamatan langit.</p>
    </div>

    <a href="{{ route('perlengkapan.create') }}" class="btn btn-primary">
        + Tambah Perlengkapan
    </a>
</div>

{{-- NOTIFIKASI --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- FILTER DAN PENCARIAN --}}
<div class="card equipment-filter-card">

    <div class="equipment-filter-heading">
        <div class="equipment-filter-icon">⌕</div>

        <div>
            <h3>Pencarian Inventaris</h3>
            <p>Temukan perlengkapan berdasarkan nama, kode, atau kondisi.</p>
        </div>
    </div>

    <form action="{{ route('perlengkapan.index') }}" method="GET" class="equipment-filter-form">

        <div class="form-group">
            <label for="search">Cari Perlengkapan</label>

            <input
                type="text"
                id="search"
                name="search"
                placeholder="Cari kode, nama, atau kategori..."
                value="{{ request('search') }}"
            >
        </div>

        <div class="form-group">
            <label for="kondisi">Kondisi Perlengkapan</label>

            <select name="kondisi" id="kondisi">
                <option value="">Semua Kondisi</option>

                <option value="baik" {{ request('kondisi') == 'baik' ? 'selected' : '' }}>
                    Baik
                </option>

                <option value="rusak_ringan" {{ request('kondisi') == 'rusak_ringan' ? 'selected' : '' }}>
                    Rusak Ringan
                </option>

                <option value="rusak_berat" {{ request('kondisi') == 'rusak_berat' ? 'selected' : '' }}>
                    Rusak Berat
                </option>
            </select>
        </div>

        <div class="equipment-filter-actions">
            <button type="submit" class="btn btn-primary">
                Cari Perlengkapan
            </button>

            <a href="{{ route('perlengkapan.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </div>

    </form>
</div>

{{-- DAFTAR PERLENGKAPAN --}}
<div class="card equipment-table-card">

    <div class="equipment-table-header">
        <div>
            <span class="section-eyebrow">INVENTORY LIST</span>
            <h3>Daftar Perlengkapan</h3>
            <p>Data inventaris yang tersimpan dalam sistem observatorium.</p>
        </div>

        <div class="equipment-total">
            <strong>{{ $perlengkapans->total() }}</strong>
            <span>Total Perlengkapan</span>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="equipment-table">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode</th>
                    <th>Nama Perlengkapan</th>
                    <th>Kategori</th>
                    <th>Kondisi</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($perlengkapans as $index => $perlengkapan)

                    <tr>
                        <td>{{ $perlengkapans->firstItem() + $index }}</td>

                        <td>
                            <span class="equipment-code">
                                {{ $perlengkapan->kode_perlengkapan }}
                            </span>
                        </td>

                        <td>
                            <div class="equipment-name-cell">
                                <strong>{{ $perlengkapan->nama_perlengkapan }}</strong>
                                <span>Peralatan observatorium</span>
                            </div>
                        </td>

                        <td>{{ $perlengkapan->kategori }}</td>

                        <td>
                            <x-status-badge :status="$perlengkapan->kondisi" />
                        </td>

                        <td>
                            <strong>{{ $perlengkapan->jumlah }}</strong>
                        </td>

                        <td>{{ $perlengkapan->satuan }}</td>

                        <td>
                            <div class="action-buttons">

                                <a
                                    href="{{ route('perlengkapan.show', $perlengkapan->id) }}"
                                    class="btn btn-sm btn-secondary"
                                >
                                    Detail
                                </a>

                                <a
                                    href="{{ route('perlengkapan.edit', $perlengkapan->id) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('perlengkapan.destroy', $perlengkapan->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus perlengkapan ini?')"
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
                        <td colspan="8">
                            <div class="equipment-empty-state">
                                <div class="equipment-empty-icon">✧</div>
                                <strong>Belum Ada Data Perlengkapan</strong>
                                <p>Data inventaris perlengkapan observasi belum tersedia.</p>
                            </div>
                        </td>
                    </tr>

                @endforelse
            </tbody>

        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $perlengkapans->links() }}
    </div>

</div>

@endsection
