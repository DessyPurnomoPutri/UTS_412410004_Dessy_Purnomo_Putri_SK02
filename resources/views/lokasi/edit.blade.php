
@extends('layouts.app')

@section('title', 'Edit Lokasi Observasi')
@section('page-title', 'Edit Lokasi')

@section('content')

{{-- HEADER FORM --}}
<div class="page-heading">
    <div>
        <span class="section-eyebrow">UPDATE OBSERVATION DESTINATION</span>
        <h2>Perbarui Lokasi Observasi</h2>
        <p>Sesuaikan informasi tempat pengamatan berdasarkan kondisi terbaru.</p>
    </div>

    <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">
        ← Kembali
    </a>
</div>

{{-- FORMULIR EDIT --}}
<div class="card location-form-card">

    <div class="location-form-header">
        <div class="form-heading-icon">✧</div>
        <div>
            <h3>Informasi Lokasi Observasi</h3>
            <p>Perbarui data lokasi yang sudah tersimpan di sistem.</p>
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

    <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST">
        @csrf
        @method('PUT')

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
                    value="{{ old('nama_lokasi', $lokasi->nama_lokasi) }}"
                    placeholder="Masukkan nama lokasi"
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
                    placeholder="Masukkan alamat lengkap lokasi..."
                    required
                >{{ old('alamat', $lokasi->alamat) }}</textarea>

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
                    <p>Perbarui titik koordinat lokasi di permukaan bumi.</p>
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
                        value="{{ old('latitude', $lokasi->latitude) }}"
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
                        value="{{ old('longitude', $lokasi->longitude) }}"
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
                    Pastikan koordinat yang dimasukkan sesuai dengan posisi
                    lokasi pengamatan agar informasi tetap akurat.
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
                    value="{{ old('tingkat_kegelapan', $lokasi->tingkat_kegelapan) }}"
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
                    placeholder="Tuliskan kondisi lingkungan atau informasi tambahan..."
                >{{ old('deskripsi', $lokasi->deskripsi) }}</textarea>

                @error('deskripsi')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- STATUS LOKASI --}}
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
                    <option value="aktif"
                        {{ old('status', $lokasi->status) == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="nonaktif"
                        {{ old('status', $lokasi->status) == 'nonaktif' ? 'selected' : '' }}>
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
                Simpan Perubahan <span>↗</span>
            </button>
        </div>

    </form>
</div>

@endsection
