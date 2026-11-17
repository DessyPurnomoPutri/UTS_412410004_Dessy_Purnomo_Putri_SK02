<?php

namespace App\Services;

use App\Models\KegiatanObservasi;
use Illuminate\Support\Facades\DB;

class KegiatanObservasiService
{
    // Menampilkan data kegiatan dengan pencarian dan filter
    public function getAll(array $filters = [])
    {
        $query = KegiatanObservasi::with('lokasi');

        if (!empty($filters['search'])) {
            $search = $filters['search'];

            $query->where(function ($q) use ($search) {
                $q->where('nama_kegiatan', 'like', "%{$search}%")
                    ->orWhere('kode_kegiatan', 'like', "%{$search}%")
                    ->orWhere('target_pengamatan', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['tanggal'])) {
            $query->whereDate('tanggal_observasi', $filters['tanggal']);
        }

        return $query->latest('tanggal_observasi')
            ->paginate(10)
            ->withQueryString();
    }

    // Menambahkan kegiatan beserta peserta dan perlengkapan
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $peserta = $data['peserta'] ?? [];
            $perlengkapan = $data['perlengkapan'] ?? [];

            unset($data['peserta'], $data['perlengkapan']);

            $kegiatan = KegiatanObservasi::create($data);

            // Menambahkan peserta ke kegiatan
            if (!empty($peserta)) {
                $pesertaData = [];

                foreach ($peserta as $pesertaId) {
                    $pesertaData[$pesertaId] = [
                        'status_keikutsertaan' => 'terdaftar',
                    ];
                }

                $kegiatan->pesertas()->sync($pesertaData);
            }

            // Menambahkan perlengkapan yang dipilih saja
            $perlengkapanTerpilih = collect($perlengkapan)
                ->filter(fn ($item) => !empty($item['perlengkapan_id']));

            foreach ($perlengkapanTerpilih as $item) {
                $kegiatan->perlengkapans()->attach(
                    $item['perlengkapan_id'],
                    [
                        'jumlah_digunakan' => $item['jumlah_digunakan'] ?? 1,
                        'catatan' => $item['catatan'] ?? null,
                    ]
                );
            }

            return $kegiatan;
        });
    }

    // Menampilkan detail kegiatan
    public function findById(int $id)
    {
        return KegiatanObservasi::with([
            'lokasi',
            'pesertas',
            'perlengkapans',
        ])->findOrFail($id);
    }

    // Mengubah kegiatan beserta relasinya
    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {

            $kegiatan = KegiatanObservasi::findOrFail($id);

            $peserta = $data['peserta'] ?? [];
            $perlengkapan = $data['perlengkapan'] ?? [];

            unset($data['peserta'], $data['perlengkapan']);

            $kegiatan->update($data);

            // Memperbarui daftar peserta
            $pesertaData = [];

            foreach ($peserta as $pesertaId) {
                $pesertaData[$pesertaId] = [
                    'status_keikutsertaan' => 'terdaftar',
                ];
            }

            $kegiatan->pesertas()->sync($pesertaData);

            // Memperbarui perlengkapan yang dipilih saja
            $perlengkapanTerpilih = collect($perlengkapan)
                ->filter(fn ($item) => !empty($item['perlengkapan_id']));

            $perlengkapanData = [];

            foreach ($perlengkapanTerpilih as $item) {
                $perlengkapanData[$item['perlengkapan_id']] = [
                    'jumlah_digunakan' => $item['jumlah_digunakan'] ?? 1,
                    'catatan' => $item['catatan'] ?? null,
                ];
            }

            $kegiatan->perlengkapans()->sync($perlengkapanData);

            return $kegiatan;
        });
    }

    // Menghapus kegiatan
    public function delete(int $id)
    {
        return DB::transaction(function () use ($id) {

            $kegiatan = KegiatanObservasi::findOrFail($id);

            $kegiatan->pesertas()->detach();
            $kegiatan->perlengkapans()->detach();

            return $kegiatan->delete();
        });
    }
}
