<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePesertaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $peserta = $this->route('peserta');

        return [
            'nama_peserta' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('peserta', 'email')->ignore($peserta?->id),
            ],
            'no_telepon' => 'nullable|string|max:20',
            'instansi' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_peserta.required' => 'Nama peserta wajib diisi.',
            'email.required' => 'Email peserta wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan peserta lain.',
        ];
    }
}