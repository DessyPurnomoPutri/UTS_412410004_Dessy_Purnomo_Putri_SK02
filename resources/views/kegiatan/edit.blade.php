
@extends('layouts.app')

@section('title', 'Edit Kegiatan Observasi')
@section('page-title', 'Edit Kegiatan')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="page-heading">
    <div>
        <span class="section-eyebrow">UPDATE OBSERVATION ACTIVITY</span>
        <h2>Perbarui Kegiatan Observasi</h2>
        <p>Sesuaikan informasi, jadwal, peserta, dan perlengkapan kegiatan observasi.</p>
    </div>

    <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">
        ← Kembali
    </a>
</div>

{{-- FORM EDIT KEGIATAN --}}
<div class="card activity-form-card">

    <div class="activity-form-header">
        <div class="form-heading-icon">☾</div>
        <div>
            <h3>Informasi Kegiatan Observasi</h3>
            <p>Periksa dan perbarui informasi kegiatan yang sudah tersimpan.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger activity-edit-alert">
            <strong>Perubahan belum berhasil disimpan. Periksa kembali:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kegiatan.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- BAGIAN 01: INFORMASI UTAMA --}}
        <div class="activity-form-section">
            <div class="form-section-heading">
                <span class="form-section-number">01</span>
                <div>
                    <h4>Informasi Utama</h4>
                    <p>Identitas kegiatan dan lokasi pelaksanaan observasi.</p>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="kode_kegiatan">Kode Kegiatan <span>*</span></label>
                    <input
                        type="text"
                        id="kode_kegiatan"
                        name="kode_kegiatan"
                        value="{{ old('kode_kegiatan', $data->kode_kegiatan) }}"
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
                        value="{{ old('nama_kegiatan', $data->nama_kegiatan) }}"
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
                            {{ old('lokasi_id', $data->lokasi_id) == $lokasi->id ? 'selected' : '' }}
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
                    value="{{ old('target_pengamatan', $data->target_pengamatan) }}"
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
                    <p>Perbarui tanggal dan waktu pelaksanaan kegiatan.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="tanggal_observasi">Tanggal Observasi <span>*</span></label>
                <input
                    type="date"
                    id="tanggal_observasi"
                    name="tanggal_observasi"
                    value="{{ old('tanggal_observasi', \Carbon\Carbon::parse($data->tanggal_observasi)->format('Y-m-d')) }}"
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
                        value="{{ old('waktu_mulai', \Carbon\Carbon::parse($data->waktu_mulai)->format('H:i')) }}"
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
                        value="{{ old('waktu_selesai', \Carbon\Carbon::parse($data->waktu_selesai)->format('H:i')) }}"
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
                    @foreach (['direncanakan', 'berlangsung', 'selesai', 'dibatalkan'] as $status)
                        <option
                            value="{{ $status }}"
                            {{ old('status', $data->status) == $status ? 'selected' : '' }}
                        >
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
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
                >{{ old('deskripsi', $data->deskripsi) }}</textarea>
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

            <div class="participant-edit-grid">
                @forelse ($pesertas as $peserta)
                    <label class="participant-edit-card">
                        <input
                            type="checkbox"
                            name="peserta[]"
                            value="{{ $peserta->id }}"
                            {{ in_array($peserta->id, old('peserta', $data->pesertas->pluck('id')->toArray())) ? 'checked' : '' }}
                        >

                        <span class="participant-edit-info">
                            <strong>{{ $peserta->nama_peserta }}</strong>
                            <small>{{ $peserta->email }}</small>
                        </span>
                    </label>
                @empty
                    <div class="equipment-empty">
                        Belum ada data peserta yang tersedia.
                    </div>
                @endforelse
            </div>

            @error('peserta')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        {{-- BAGIAN 04: PERLENGKAPAN --}}
        <div class="activity-form-section">
            <div class="form-section-heading">
                <span class="form-section-number">04</span>
                <div>
                    <h4>Perlengkapan Observasi</h4>
                    <p>Perbarui perlengkapan yang digunakan beserta jumlah dan catatannya.</p>
                </div>
            </div>

            @forelse ($perlengkapans as $index => $perlengkapan)
                @php
                    $terpilih = $data->perlengkapans->firstWhere('id', $perlengkapan->id);
                    $oldPerlengkapan = old('perlengkapan.' . $index);

                    $checked = $oldPerlengkapan !== null
                        ? !empty($oldPerlengkapan['perlengkapan_id'])
                        : (bool) $terpilih;
                @endphp

                <div class="equipment-item">
                    <div class="equipment-item-heading">
                        <label class="equipment-checkbox">
                            <input
                                type="checkbox"
                                name="perlengkapan[{{ $index }}][perlengkapan_id]"
                                value="{{ $perlengkapan->id }}"
                                {{ $checked ? 'checked' : '' }}
                            >

                            <span>{{ $perlengkapan->nama_perlengkapan }}</span>
                        </label>

                        <small>
                            {{ $perlengkapan->kode_perlengkapan }}
                            · Stok tersedia: {{ $perlengkapan->jumlah }} {{ $perlengkapan->satuan }}
                        </small>
                    </div>

                    <div class="equipment-input-grid">
                        <div class="form-group">
                            <label for="jumlah_{{ $index }}">Jumlah Digunakan</label>
                            <input
                                type="number"
                                id="jumlah_{{ $index }}"
                                name="perlengkapan[{{ $index }}][jumlah_digunakan]"
                                min="1"
                                value="{{ old('perlengkapan.' . $index . '.jumlah_digunakan', $terpilih?->pivot->jumlah_digunakan ?? 1) }}"
                            >
                        </div>

                        <div class="form-group">
                            <label for="catatan_{{ $index }}">Catatan Penggunaan</label>
                            <input
                                type="text"
                                id="catatan_{{ $index }}"
                                name="perlengkapan[{{ $index }}][catatan]"
                                value="{{ old('perlengkapan.' . $index . '.catatan', $terpilih?->pivot->catatan ?? '') }}"
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

        {{-- TOMBOL AKSI --}}
        <div class="form-actions activity-form-actions">
            <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan <span>↗</span>
            </button>
        </div>

    </form>
</div>

@endsection
