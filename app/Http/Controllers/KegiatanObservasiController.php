<?php

namespace App\Http\Controllers;

use App\Models\KegiatanObservasi;
use App\Models\LokasiObservasi;
use App\Models\Peserta;
use App\Models\Perlengkapan;
use App\Services\KegiatanObservasiService;
use App\Http\Requests\StoreKegiatanObservasiRequest;
use App\Http\Requests\UpdateKegiatanObservasiRequest;

class KegiatanObservasiController extends Controller
{
    protected $kegiatanService;

    public function __construct(KegiatanObservasiService $kegiatanService)
    {
        $this->kegiatanService = $kegiatanService;
    }

    // Menampilkan seluruh kegiatan
    public function index()
    {
        $kegiatans = $this->kegiatanService->getAll(
            request()->only(['search', 'status', 'tanggal'])
        );

        return view('kegiatan.index', compact('kegiatans'));
    }

    // Menampilkan form tambah kegiatan
    public function create()
    {
        $lokasis = LokasiObservasi::where('status', 'aktif')->get();
        $pesertas = Peserta::orderBy('nama_peserta')->get();
        $perlengkapans = Perlengkapan::where('kondisi', 'baik')
            ->where('jumlah', '>', 0)
            ->orderBy('nama_perlengkapan')
            ->get();

        return view('kegiatan.create', compact(
            'lokasis',
            'pesertas',
            'perlengkapans'
        ));
    }

    // Menyimpan kegiatan baru
    public function store(StoreKegiatanObservasiRequest $request)
    {
        $data = $request->validated();

        $this->kegiatanService->create($data);

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan observasi berhasil ditambahkan.');
    }

    // Menampilkan detail kegiatan
    public function show(KegiatanObservasi $kegiatan)
    {
        $data = $this->kegiatanService->findById($kegiatan->id);

        return view('kegiatan.show', compact('data'));
    }

    // Menampilkan form edit kegiatan
    public function edit(KegiatanObservasi $kegiatan)
    {
        $lokasis = LokasiObservasi::where('status', 'aktif')->get();
        $pesertas = Peserta::orderBy('nama_peserta')->get();
        $perlengkapans = Perlengkapan::where('kondisi', 'baik')
            ->where('jumlah', '>', 0)
            ->orderBy('nama_perlengkapan')
            ->get();

        $data = $this->kegiatanService->findById($kegiatan->id);

        return view('kegiatan.edit', compact(
            'data',
            'lokasis',
            'pesertas',
            'perlengkapans'
        ));
    }

    // Memperbarui kegiatan
    public function update(
        UpdateKegiatanObservasiRequest $request,
        KegiatanObservasi $kegiatan
    ) {
        $this->kegiatanService->update(
            $kegiatan->id,
            $request->validated()
        );

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan observasi berhasil diperbarui.');
    }

    // Menghapus kegiatan
    public function destroy(KegiatanObservasi $kegiatan)
    {
        $this->kegiatanService->delete($kegiatan->id);

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan observasi berhasil dihapus.');
    }
}
