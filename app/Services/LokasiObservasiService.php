<?php

namespace App\Services;

use App\Models\LokasiObservasi;

class LokasiObservasiService
{
    // Menampilkan seluruh data lokasi
    public function getAll(array $filters = [])
    {
        $query = LokasiObservasi::query();

        // Pencarian berdasarkan nama atau alamat
        if (!empty($filters['search'])) {
            $search = $filters['search'];

            $query->where(function ($q) use ($search) {
                $q->where('nama_lokasi', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan status
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest()->paginate(10)->withQueryString();
    }

    // Menambahkan lokasi baru
    public function create(array $data)
    {
        return LokasiObservasi::create($data);
    }

    // Menampilkan detail lokasi
    public function findById(int $id)
    {
        return LokasiObservasi::with('kegiatans')->findOrFail($id);
    }

    // Mengubah data lokasi
    public function update(int $id, array $data)
    {
        $lokasi = LokasiObservasi::findOrFail($id);

        $lokasi->update($data);

        return $lokasi;
    }

    // Menghapus data lokasi
    public function delete(int $id)
    {
        $lokasi = LokasiObservasi::findOrFail($id);

        return $lokasi->delete();
    }
}
