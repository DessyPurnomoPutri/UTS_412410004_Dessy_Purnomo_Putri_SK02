<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePesertaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_peserta' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:peserta,email',
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
            'email.unique' => 'Email sudah terdaftar.',
        ];
    }
}