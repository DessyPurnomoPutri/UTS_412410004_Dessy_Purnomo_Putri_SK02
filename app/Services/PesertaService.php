<?php

namespace App\Services;

use App\Models\Peserta;

class PesertaService
{
    // Menampilkan data peserta dengan pencarian
    public function getAll(array $filters = [])
    {
        $query = Peserta::query();

        // Pencarian nama, email, dan instansi
        if (!empty($filters['search'])) {
            $search = $filters['search'];

            $query->where(function ($q) use ($search) {
                $q->where('nama_peserta', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('instansi', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate(10)->withQueryString();
    }

    // Menambahkan peserta baru
    public function create(array $data)
    {
        return Peserta::create($data);
    }

    // Menampilkan detail peserta beserta kegiatan
    public function findById(int $id)
    {
        return Peserta::with('kegiatans')->findOrFail($id);
    }

    // Mengubah data peserta
    public function update(int $id, array $data)
    {
        $peserta = Peserta::findOrFail($id);

        $peserta->update($data);

        return $peserta;
    }

    // Menghapus data peserta
    public function delete(int $id)
    {
        $peserta = Peserta::findOrFail($id);

        return $peserta->delete();
    }
}
