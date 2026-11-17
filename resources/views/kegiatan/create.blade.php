
@extends('layouts.app')

@section('title', 'Tambah Kegiatan Observasi')
@section('page-title', 'Tambah Kegiatan')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="page-heading">
    <div>
        <span class="section-eyebrow">NEW OBSERVATION ACTIVITY</span>
        <h2>Rencanakan Kegiatan Observasi</h2>
        <p>Masukkan jadwal, lokasi, peserta, dan perlengkapan untuk kegiatan pengamatan langit.</p>
    </div>

    <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">
        ← Kembali
    </a>
</div>

{{-- FORMULIR KEGIATAN --}}
<div class="card activity-form-card">

    <div class="activity-form-header">
        <div class="form-heading-icon">☾</div>
        <div>
            <h3>Informasi Kegiatan Observasi</h3>
            <p>Lengkapi informasi kegiatan sebelum menyimpannya ke dalam sistem.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Data belum berhasil disimpan. Periksa kembali:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kegiatan.store') }}" method="POST">
        @csrf

        {{-- BAGIAN 01: INFORMASI KEGIATAN --}}
        <div class="activity-form-section">
            <div class="form-section-heading">
                <span class="form-section-number">01</span>
                <div>
                    <h4>Informasi Utama</h4>
                    <p>Identitas dan lokasi pelaksanaan kegiatan observasi.</p>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="kode_kegiatan">Kode Kegiatan <span>*</span></label>
                    <input
                        type="text"
                        id="kode_kegiatan"
                        name="kode_kegiatan"
                        value="{{ old('kode_kegiatan') }}"
                        placeholder="Contoh: OBS002"
                        required
                    >
                    @error('kode_kegiatan')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan <span>*</span></label>
                    <input
                        type="text"
                        id="nama_kegiatan"
                        name="nama_kegiatan"
                        value="{{ old('nama_kegiatan') }}"
                        placeholder="Contoh: Pengamatan Planet Jupiter"
                        required
                    >
                    @error('nama_kegiatan')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="lokasi_id">Lokasi Observasi <span>*</span></label>
                <select name="lokasi_id" id="lokasi_id" required>
                    <option value="">Pilih lokasi observasi</option>

                    @foreach ($lokasis as $lokasi)
                        <option
                            value="{{ $lokasi->id }}"
                            {{ old('lokasi_id') == $lokasi->id ? 'selected' : '' }}
                        >
                            {{ $lokasi->nama_lokasi }}
                        </option>
                    @endforeach
                </select>

                @error('lokasi_id')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="target_pengamatan">Target Pengamatan <span>*</span></label>
                <input
                    type="text"
                    id="target_pengamatan"
                    name="target_pengamatan"
                    value="{{ old('target_pengamatan') }}"
                    placeholder="Contoh: Bulan dan Planet Jupiter"
                    required
                >

                @error('target_pengamatan')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- BAGIAN 02: JADWAL --}}
        <div class="activity-form-section">
            <div class="form-section-heading">
                <span class="form-section-number">02</span>
                <div>
                    <h4>Jadwal Observasi</h4>
                    <p>Tentukan tanggal dan rentang waktu kegiatan berlangsung.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="tanggal_observasi">Tanggal Observasi <span>*</span></label>
                <input
                    type="date"
                    id="tanggal_observasi"
                    name="tanggal_observasi"
                    value="{{ old('tanggal_observasi') }}"
                    required
                >

                @error('tanggal_observasi')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="waktu_mulai">Waktu Mulai <span>*</span></label>
                    <input
                        type="time"
                        id="waktu_mulai"
                        name="waktu_mulai"
                        value="{{ old('waktu_mulai') }}"
                        required
                    >

                    @error('waktu_mulai')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="waktu_selesai">Waktu Selesai <span>*</span></label>
                    <input
                        type="time"
                        id="waktu_selesai"
                        name="waktu_selesai"
                        value="{{ old('waktu_selesai') }}"
                        required
                    >

                    @error('waktu_selesai')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="status">Status Kegiatan <span>*</span></label>
                <select name="status" id="status" required>
                    <option value="direncanakan" {{ old('status', 'direncanakan') == 'direncanakan' ? 'selected' : '' }}>
                        Direncanakan
                    </option>
                    <option value="berlangsung" {{ old('status') == 'berlangsung' ? 'selected' : '' }}>
                        Berlangsung
                    </option>
                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>
                    <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>
                        Dibatalkan
                    </option>
                </select>

                @error('status')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Kegiatan</label>
                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="4"
                    placeholder="Tuliskan informasi tambahan mengenai kegiatan observasi..."
                >{{ old('deskripsi') }}</textarea>

                @error('deskripsi')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- BAGIAN 03: PESERTA --}}
        <div class="activity-form-section">
            <div class="form-section-heading">
                <span class="form-section-number">03</span>
                <div>
                    <h4>Peserta Kegiatan</h4>
                    <p>Pilih peserta yang akan mengikuti kegiatan observasi.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="peserta">Daftar Peserta</label>

                <select name="peserta[]" id="peserta" multiple size="5" class="participant-select">
                    @foreach ($pesertas as $peserta)
                        <option
                            value="{{ $peserta->id }}"
                            {{ in_array($peserta->id, old('peserta', [])) ? 'selected' : '' }}
                        >
                            {{ $peserta->nama_peserta }} — {{ $peserta->email }}
                        </option>
                    @endforeach
                </select>

                <small class="form-hint">
                    Tahan tombol Ctrl (Windows) atau Command (Mac) untuk memilih lebih dari satu peserta.
                </small>

                @error('peserta')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- BAGIAN 04: PERLENGKAPAN --}}
        <div class="activity-form-section">
            <div class="form-section-heading">
                <span class="form-section-number">04</span>
                <div>
                    <h4>Perlengkapan Observasi</h4>
                    <p>Pilih perlengkapan yang digunakan beserta jumlah dan catatannya.</p>
                </div>
            </div>

            @forelse ($perlengkapans as $perlengkapan)
                @php
                    $oldPerlengkapan = collect(old('perlengkapan', []))
                        ->firstWhere('perlengkapan_id', $perlengkapan->id);
                @endphp

                <div class="equipment-item">

                    <div class="equipment-item-heading">
                        <label class="equipment-checkbox">
                            <input
                                type="checkbox"
                                name="perlengkapan[{{ $loop->index }}][perlengkapan_id]"
                                value="{{ $perlengkapan->id }}"
                                {{ $oldPerlengkapan ? 'checked' : '' }}
                            >

                            <span>{{ $perlengkapan->nama_perlengkapan }}</span>
                        </label>

                        <small>
                            Stok tersedia: {{ $perlengkapan->jumlah }} {{ $perlengkapan->satuan }}
                        </small>
                    </div>

                    <div class="equipment-input-grid">
                        <div class="form-group">
                            <label>Jumlah Digunakan</label>
                            <input
                                type="number"
                                name="perlengkapan[{{ $loop->index }}][jumlah_digunakan]"
                                min="1"
                                max="{{ $perlengkapan->jumlah }}"
                                value="{{ old('perlengkapan.' . $loop->index . '.jumlah_digunakan', 1) }}"
                            >
                        </div>

                        <div class="form-group">
                            <label>Catatan Penggunaan</label>
                            <input
                                type="text"
                                name="perlengkapan[{{ $loop->index }}][catatan]"
                                value="{{ old('perlengkapan.' . $loop->index . '.catatan') }}"
                                placeholder="Catatan tambahan (opsional)"
                            >
                        </div>
                    </div>
                </div>
            @empty
                <div class="equipment-empty">
                    Belum ada data perlengkapan. Tambahkan perlengkapan terlebih dahulu melalui menu Perlengkapan.
                </div>
            @endforelse
        </div>

        {{-- TOMBOL --}}
        <div class="form-actions activity-form-actions">
            <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                Simpan Kegiatan <span>↗</span>
            </button>
        </div>

    </form>
</div>

@endsection
