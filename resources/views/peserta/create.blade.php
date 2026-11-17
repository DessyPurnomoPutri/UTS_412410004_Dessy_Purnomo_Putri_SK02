
@extends('layouts.app')

@section('title', 'Tambah Peserta')
@section('page-title', 'Tambah Peserta')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="page-heading">
    <div>
        <span class="section-eyebrow">NEW OBSERVATION PARTICIPANT</span>
        <h2>Tambah Peserta Observasi</h2>
        <p>Daftarkan peserta baru yang akan mengikuti kegiatan pengamatan langit.</p>
    </div>

    <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
        ← Kembali
    </a>
</div>

{{-- FORMULIR PESERTA --}}
<div class="card participant-form-card">

    <div class="participant-form-header">
        <div class="participant-form-icon">♧</div>

        <div>
            <h3>Formulir Data Peserta</h3>
            <p>Lengkapi informasi identitas dan kontak peserta di bawah ini.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger participant-form-alert">
            <strong>Data belum berhasil disimpan. Periksa kembali:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peserta.store') }}" method="POST">
        @csrf

        {{-- BAGIAN 01: IDENTITAS --}}
        <div class="participant-form-section">

            <div class="form-section-heading">
                <span class="form-section-number">01</span>

                <div>
                    <h4>Identitas Peserta</h4>
                    <p>Masukkan nama lengkap dan alamat email peserta.</p>
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
                    value="{{ old('nama_peserta') }}"
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
                    value="{{ old('email') }}"
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
                    <p>Lengkapi nomor telepon dan asal instansi peserta.</p>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="no_telepon">Nomor Telepon</label>

                    <input
                        type="text"
                        id="no_telepon"
                        name="no_telepon"
                        value="{{ old('no_telepon') }}"
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
                        value="{{ old('instansi') }}"
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
                    <p>Masukkan alamat tempat tinggal atau alamat peserta.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>

                <textarea
                    id="alamat"
                    name="alamat"
                    rows="4"
                    placeholder="Masukkan alamat lengkap peserta..."
                >{{ old('alamat') }}</textarea>

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
                Simpan Peserta <span>↗</span>
            </button>

        </div>

    </form>
</div>

@endsection
