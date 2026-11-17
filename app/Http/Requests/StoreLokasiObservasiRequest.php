<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLokasiObservasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_lokasi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'tingkat_kegelapan' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_lokasi.required' => 'Nama lokasi wajib diisi.',
            'alamat.required' => 'Alamat lokasi wajib diisi.',
            'latitude.between' => 'Latitude harus berada antara -90 sampai 90.',
            'longitude.between' => 'Longitude harus berada antara -180 sampai 180.',
            'tingkat_kegelapan.required' => 'Tingkat kegelapan wajib diisi.',
            'status.in' => 'Status lokasi tidak valid.',
        ];
    }
}