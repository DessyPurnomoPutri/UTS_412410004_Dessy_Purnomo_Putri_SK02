<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKegiatanObservasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $kegiatan = $this->route('kegiatan');

        return [
            'lokasi_id' => 'required|exists:lokasi_observasi,id',
            'kode_kegiatan' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kegiatan_observasi', 'kode_kegiatan')
                    ->ignore($kegiatan?->id),
            ],
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_observasi' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'target_pengamatan' => 'required|string|max:255',
            'status' => 'required|in:direncanakan,berlangsung,selesai,dibatalkan',
            'deskripsi' => 'nullable|string',

            'peserta' => 'nullable|array',
'peserta.*' => 'integer|exists:peserta,id',

'perlengkapan' => 'nullable|array',
'perlengkapan.*.perlengkapan_id' => 'nullable|integer|exists:perlengkapan,id',
'perlengkapan.*.jumlah_digunakan' => 'nullable|integer|min:1',
'perlengkapan.*.catatan' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'lokasi_id.required' => 'Lokasi observasi wajib dipilih.',
            'lokasi_id.exists' => 'Lokasi observasi tidak ditemukan.',
            'kode_kegiatan.required' => 'Kode kegiatan wajib diisi.',
            'kode_kegiatan.unique' => 'Kode kegiatan sudah digunakan.',
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi.',
            'tanggal_observasi.required' => 'Tanggal observasi wajib diisi.',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi.',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
            'target_pengamatan.required' => 'Target pengamatan wajib diisi.',
            'status.in' => 'Status kegiatan tidak valid.',
        ];
    }
}
