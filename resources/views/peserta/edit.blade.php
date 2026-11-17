
@extends('layouts.app')

@section('title', 'Edit Peserta')
@section('page-title', 'Edit Peserta')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="page-heading">
    <div>
        <span class="section-eyebrow">UPDATE OBSERVATION PARTICIPANT</span>
        <h2>Edit Data Peserta</h2>
        <p>Perbarui informasi peserta observasi sesuai data terbaru.</p>
    </div>

    <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
        ← Kembali
    </a>
</div>

{{-- FORM EDIT PESERTA --}}
<div class="card participant-form-card">

    <div class="participant-form-header">
        <div class="participant-form-icon">✎</div>

        <div>
            <h3>Formulir Edit Peserta</h3>
            <p>Pastikan informasi peserta yang diperbarui sudah benar.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger participant-form-alert">
            <strong>Data belum berhasil diperbarui. Periksa kembali:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peserta.update', $peserta->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- BAGIAN 01: IDENTITAS --}}
        <div class="participant-form-section">

            <div class="form-section-heading">
                <span class="form-section-number">01</span>

                <div>
                    <h4>Identitas Peserta</h4>
                    <p>Perbarui nama lengkap dan alamat email peserta.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="nama_peserta">
                    Nama Lengkap <span>*</span>
                </label>

                <input
                    type="text"
                    id="nama_peserta"
                    name="nama_peserta"
                    value="{{ old('nama_peserta', $peserta->nama_peserta) }}"
                    placeholder="Masukkan nama lengkap peserta"
                    required
                >

                @error('nama_peserta')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">
                    Email <span>*</span>
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $peserta->email) }}"
                    placeholder="contoh@email.com"
                    required
                >

                @error('email')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

        </div>

        {{-- BAGIAN 02: INFORMASI KONTAK --}}
        <div class="participant-form-section">

            <div class="form-section-heading">
                <span class="form-section-number">02</span>

                <div>
                    <h4>Informasi Kontak</h4>
                    <p>Perbarui nomor telepon dan instansi peserta.</p>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="no_telepon">Nomor Telepon</label>

                    <input
                        type="text"
                        id="no_telepon"
                        name="no_telepon"
                        value="{{ old('no_telepon', $peserta->no_telepon) }}"
                        placeholder="Contoh: 081234567890"
                    >

                    @error('no_telepon')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="instansi">Instansi</label>

                    <input
                        type="text"
                        id="instansi"
                        name="instansi"
                        value="{{ old('instansi', $peserta->instansi) }}"
                        placeholder="Contoh: Universitas Indonesia"
                    >

                    @error('instansi')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

        </div>

        {{-- BAGIAN 03: ALAMAT --}}
        <div class="participant-form-section">

            <div class="form-section-heading">
                <span class="form-section-number">03</span>

                <div>
                    <h4>Alamat Peserta</h4>
                    <p>Perbarui alamat tempat tinggal atau alamat peserta.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>

                <textarea
                    id="alamat"
                    name="alamat"
                    rows="4"
                    placeholder="Masukkan alamat lengkap peserta..."
                >{{ old('alamat', $peserta->alamat) }}</textarea>

                @error('alamat')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

        </div>

        {{-- TOMBOL AKSI --}}
        <div class="form-actions participant-form-actions">

            <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan <span>↗</span>
            </button>

        </div>

    </form>
</div>

@endsection
