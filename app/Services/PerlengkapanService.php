<?php

namespace App\Services;

use App\Models\Perlengkapan;

class PerlengkapanService
{
    // Menampilkan data perlengkapan dengan pencarian dan filter
    public function getAll(array $filters = [])
    {
        $query = Perlengkapan::query();

        // Pencarian berdasarkan kode atau nama
        if (!empty($filters['search'])) {
            $search = $filters['search'];

            $query->where(function ($q) use ($search) {
                $q->where('kode_perlengkapan', 'like', "%{$search}%")
                    ->orWhere('nama_perlengkapan', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kondisi
        if (!empty($filters['kondisi'])) {
            $query->where('kondisi', $filters['kondisi']);
        }

        // Filter berdasarkan kategori
        if (!empty($filters['kategori'])) {
            $query->where('kategori', $filters['kategori']);
        }

        return $query->latest()->paginate(10)->withQueryString();
    }

    // Menambahkan perlengkapan baru
    public function create(array $data)
    {
        return Perlengkapan::create($data);
    }

    // Menampilkan detail perlengkapan beserta kegiatan
    public function findById(int $id)
    {
        return Perlengkapan::with('kegiatans')->findOrFail($id);
    }

    // Mengubah data perlengkapan
    public function update(int $id, array $data)
    {
        $perlengkapan = Perlengkapan::findOrFail($id);

        $perlengkapan->update($data);

        return $perlengkapan;
    }

    // Menghapus data perlengkapan
    public function delete(int $id)
    {
        $perlengkapan = Perlengkapan::findOrFail($id);

        return $perlengkapan->delete();
    }
}
