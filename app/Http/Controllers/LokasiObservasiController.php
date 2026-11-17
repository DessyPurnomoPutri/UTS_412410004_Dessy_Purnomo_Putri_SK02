<?php

namespace App\Http\Controllers;

use App\Models\LokasiObservasi;
use App\Services\LokasiObservasiService;
use App\Http\Requests\StoreLokasiObservasiRequest;
use App\Http\Requests\UpdateLokasiObservasiRequest;

class LokasiObservasiController extends Controller
{
    protected $lokasiService;

    public function __construct(LokasiObservasiService $lokasiService)
    {
        $this->lokasiService = $lokasiService;
    }

    // Menampilkan seluruh data lokasi
    public function index()
    {
        $lokasis = $this->lokasiService->getAll(
            request()->only(['search', 'status'])
        );

        return view('lokasi.index', compact('lokasis'));
    }

    // Menampilkan halaman tambah lokasi
    public function create()
    {
        return view('lokasi.create');
    }

    // Menyimpan lokasi baru
    public function store(StoreLokasiObservasiRequest $request)
    {
        $this->lokasiService->create($request->validated());

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Data lokasi berhasil ditambahkan.');
    }

    // Menampilkan detail lokasi
    public function show(LokasiObservasi $lokasi)
    {
        $lokasi = $this->lokasiService->findById($lokasi->id);

        return view('lokasi.show', compact('lokasi'));
    }

    // Menampilkan halaman edit lokasi
    public function edit(LokasiObservasi $lokasi)
    {
        return view('lokasi.edit', compact('lokasi'));
    }

    // Memperbarui data lokasi
    public function update(
        UpdateLokasiObservasiRequest $request,
        LokasiObservasi $lokasi
    ) {
        $this->lokasiService->update(
            $lokasi->id,
            $request->validated()
        );

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Data lokasi berhasil diperbarui.');
    }

    
// Menghapus data lokasi
public function destroy(LokasiObservasi $lokasi)
{
    $this->lokasiService->delete($lokasi->id);

    return redirect()
        ->route('lokasi.index')
        ->with('success', 'Data lokasi berhasil dihapus.');
}

    
}
