
@extends('layouts.app')

@section('title', 'Tambah Perlengkapan')
@section('page-title', 'Tambah Perlengkapan')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="page-heading">
    <div>
        <span class="section-eyebrow">NEW OBSERVATION EQUIPMENT</span>
        <h2>Tambah Perlengkapan Observasi</h2>
        <p>Tambahkan inventaris peralatan untuk mendukung kegiatan pengamatan langit.</p>
    </div>

    <a href="{{ route('perlengkapan.index') }}" class="btn btn-secondary">
        ← Kembali
    </a>
</div>

{{-- FORMULIR PERLENGKAPAN --}}
<div class="card equipment-form-card">

    <div class="equipment-form-header">
        <div class="equipment-form-icon">✧</div>

        <div>
            <h3>Formulir Data Perlengkapan</h3>
            <p>Lengkapi informasi inventaris yang akan didaftarkan ke sistem.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger equipment-form-alert">
            <strong>Data belum berhasil disimpan. Periksa kembali:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('perlengkapan.store') }}" method="POST">
        @csrf

        {{-- BAGIAN 01: IDENTITAS PERLENGKAPAN --}}
        <div class="equipment-form-section">

            <div class="form-section-heading">
                <span class="form-section-number">01</span>

                <div>
                    <h4>Identitas Perlengkapan</h4>
                    <p>Masukkan kode, nama, dan kategori inventaris.</p>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="kode_perlengkapan">
                        Kode Perlengkapan <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="kode_perlengkapan"
                        name="kode_perlengkapan"
                        value="{{ old('kode_perlengkapan') }}"
                        placeholder="Contoh: PRK006"
                        required
                    >

                    @error('kode_perlengkapan')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama_perlengkapan">
                        Nama Perlengkapan <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="nama_perlengkapan"
                        name="nama_perlengkapan"
                        value="{{ old('nama_perlengkapan') }}"
                        placeholder="Masukkan nama perlengkapan"
                        required
                    >

                    @error('nama_perlengkapan')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategori">
                        Kategori <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="kategori"
                        name="kategori"
                        value="{{ old('kategori') }}"
                        placeholder="Contoh: Optik, Aksesori, Penerangan"
                        required
                    >

                    @error('kategori')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

            </div>
        </div>

        {{-- BAGIAN 02: KONDISI DAN JUMLAH --}}
        <div class="equipment-form-section">

            <div class="form-section-heading">
                <span class="form-section-number">02</span>

                <div>
                    <h4>Kondisi dan Ketersediaan</h4>
                    <p>Tentukan kondisi fisik dan jumlah perlengkapan yang tersedia.</p>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="kondisi">
                        Kondisi Perlengkapan <span>*</span>
                    </label>

                    <select id="kondisi" name="kondisi" required>
                        <option value="">Pilih Kondisi</option>

                        <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>
                            Baik
                        </option>

                        <option value="rusak_ringan" {{ old('kondisi') == 'rusak_ringan' ? 'selected' : '' }}>
                            Rusak Ringan
                        </option>

                        <option value="rusak_berat" {{ old('kondisi') == 'rusak_berat' ? 'selected' : '' }}>
                            Rusak Berat
                        </option>
                    </select>

                    @error('kondisi')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jumlah">
                        Jumlah <span>*</span>
                    </label>

                    <input
                        type="number"
                        id="jumlah"
                        name="jumlah"
                        value="{{ old('jumlah', 1) }}"
                        min="0"
                        required
                    >

                    @error('jumlah')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="satuan">
                        Satuan <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="satuan"
                        name="satuan"
                        value="{{ old('satuan') }}"
                        placeholder="Contoh: Unit, Buah, Set"
                        required
                    >

                    @error('satuan')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

            </div>
        </div>

        {{-- BAGIAN 03: KETERANGAN --}}
        <div class="equipment-form-section">

            <div class="form-section-heading">
                <span class="form-section-number">03</span>

                <div>
                    <h4>Keterangan Tambahan</h4>
                    <p>Tambahkan informasi pendukung mengenai perlengkapan.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>

                <textarea
                    id="keterangan"
                    name="keterangan"
                    rows="4"
                    placeholder="Tambahkan keterangan perlengkapan jika diperlukan..."
                >{{ old('keterangan') }}</textarea>

                @error('keterangan')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

        </div>

        {{-- TOMBOL AKSI --}}
        <div class="form-actions equipment-form-actions">

            <a href="{{ route('perlengkapan.index') }}" class="btn btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                Simpan Perlengkapan <span>↗</span>
            </button>

        </div>

    </form>
</div>

@endsection
