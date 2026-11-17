
@extends('layouts.app')

@section('title', 'Tambah Lokasi Observasi')
@section('page-title', 'Tambah Lokasi')

@section('content')

{{-- HEADER FORM --}}
<div class="page-heading location-form-page-heading">
    <div>
        <span class="section-eyebrow">NEW OBSERVATION DESTINATION</span>
        <h2>Daftarkan Lokasi Baru</h2>
        <p>Tambahkan informasi tempat yang akan digunakan untuk kegiatan pengamatan langit.</p>
    </div>

    <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">
        ← Kembali
    </a>
</div>

{{-- FORMULIR --}}
<div class="card location-form-card">

    <div class="location-form-header">
        <div class="form-heading-icon">✦</div>
        <div>
            <h3>Informasi Lokasi Observasi</h3>
            <p>Lengkapi setiap informasi sesuai dengan kondisi lokasi sebenarnya.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lokasi.store') }}" method="POST">
        @csrf

        {{-- INFORMASI UTAMA --}}
        <div class="location-form-section">
            <div class="form-section-heading">
                <span class="form-section-number">01</span>
                <div>
                    <h4>Informasi Utama</h4>
                    <p>Identitas dan alamat lokasi pengamatan.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="nama_lokasi">
                    Nama Lokasi <span>*</span>
                </label>

                <input
                    type="text"
                    id="nama_lokasi"
                    name="nama_lokasi"
                    value="{{ old('nama_lokasi') }}"
                    placeholder="Contoh: Observatorium Bosscha"
                    required
                >

                @error('nama_lokasi')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">
                    Alamat Lengkap <span>*</span>
                </label>

                <textarea
                    id="alamat"
                    name="alamat"
                    rows="3"
                    placeholder="Masukkan alamat lengkap lokasi pengamatan..."
                    required
                >{{ old('alamat') }}</textarea>

                @error('alamat')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- KOORDINAT --}}
        <div class="location-form-section">
            <div class="form-section-heading">
                <span class="form-section-number">02</span>
                <div>
                    <h4>Koordinat Geografis</h4>
                    <p>Informasi titik koordinat lokasi di permukaan bumi.</p>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="latitude">Latitude</label>

                    <input
                        type="number"
                        step="any"
                        id="latitude"
                        name="latitude"
                        value="{{ old('latitude') }}"
                        placeholder="Contoh: -6.825"
                    >

                    @error('latitude')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude</label>

                    <input
                        type="number"
                        step="any"
                        id="longitude"
                        name="longitude"
                        value="{{ old('longitude') }}"
                        placeholder="Contoh: 107.637"
                    >

                    @error('longitude')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="coordinate-note">
                <span>✧</span>
                <p>
                    Koordinat geografis digunakan untuk menunjukkan posisi
                    lokasi pengamatan secara lebih akurat.
                </p>
            </div>
        </div>

        {{-- KONDISI LANGIT --}}
        <div class="location-form-section">
            <div class="form-section-heading">
                <span class="form-section-number">03</span>
                <div>
                    <h4>Kondisi dan Deskripsi</h4>
                    <p>Informasi kualitas langit dan karakteristik lokasi.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="tingkat_kegelapan">
                    Tingkat Kegelapan Langit <span>*</span>
                </label>

                <input
                    type="text"
                    id="tingkat_kegelapan"
                    name="tingkat_kegelapan"
                    value="{{ old('tingkat_kegelapan') }}"
                    placeholder="Contoh: Bortle Class 3"
                    required
                >

                @error('tingkat_kegelapan')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Lokasi</label>

                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="4"
                    placeholder="Tuliskan kondisi lingkungan, akses menuju lokasi, atau informasi tambahan lainnya..."
                >{{ old('deskripsi') }}</textarea>

                @error('deskripsi')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- STATUS --}}
        <div class="location-form-section">
            <div class="form-section-heading">
                <span class="form-section-number">04</span>
                <div>
                    <h4>Status Lokasi</h4>
                    <p>Tentukan ketersediaan lokasi untuk kegiatan observasi.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="status">
                    Status Lokasi <span>*</span>
                </label>

                <select name="status" id="status" required>
                    <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>

                @error('status')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- TOMBOL --}}
        <div class="form-actions location-form-actions">
            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                Simpan Lokasi <span>↗</span>
            </button>
        </div>

    </form>
</div>

@endsection