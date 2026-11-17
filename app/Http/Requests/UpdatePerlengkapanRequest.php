<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePerlengkapanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $perlengkapan = $this->route('perlengkapan');

        return [
            'kode_perlengkapan' => [
                'required',
                'string',
                'max:255',
                Rule::unique('perlengkapan', 'kode_perlengkapan')
                    ->ignore($perlengkapan?->id),
            ],
            'nama_perlengkapan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'jumlah' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'kode_perlengkapan.required' => 'Kode perlengkapan wajib diisi.',
            'kode_perlengkapan.unique' => 'Kode perlengkapan sudah digunakan.',
            'nama_perlengkapan.required' => 'Nama perlengkapan wajib diisi.',
            'kategori.required' => 'Kategori perlengkapan wajib diisi.',
            'kondisi.required' => 'Kondisi perlengkapan wajib dipilih.',
            'kondisi.in' => 'Pilihan kondisi tidak valid.',
            'jumlah.required' => 'Jumlah perlengkapan wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka bulat.',
            'jumlah.min' => 'Jumlah tidak boleh kurang dari 0.',
            'satuan.required' => 'Satuan perlengkapan wajib diisi.',
        ];
    }
}
