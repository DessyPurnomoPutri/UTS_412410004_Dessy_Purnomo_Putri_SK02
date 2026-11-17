<?php

namespace App\Http\Controllers;

use App\Models\Perlengkapan;
use App\Services\PerlengkapanService;
use App\Http\Requests\StorePerlengkapanRequest;
use App\Http\Requests\UpdatePerlengkapanRequest;

class PerlengkapanController extends Controller
{
    protected $perlengkapanService;

    public function __construct(PerlengkapanService $perlengkapanService)
    {
        $this->perlengkapanService = $perlengkapanService;
    }

    // Menampilkan seluruh data perlengkapan
    public function index()
    {
        $perlengkapans = $this->perlengkapanService->getAll(
            request()->only(['search', 'kondisi', 'kategori'])
        );

        return view('perlengkapan.index', compact('perlengkapans'));
    }

    // Menampilkan form tambah perlengkapan
    public function create()
    {
        return view('perlengkapan.create');
    }

    // Menyimpan perlengkapan baru
    public function store(StorePerlengkapanRequest $request)
    {
        $this->perlengkapanService->create($request->validated());

        return redirect()
            ->route('perlengkapan.index')
            ->with('success', 'Data perlengkapan berhasil ditambahkan.');
    }

    // Menampilkan detail perlengkapan
    public function show(Perlengkapan $perlengkapan)
    {
        $perlengkapan = $this->perlengkapanService->findById(
            $perlengkapan->id
        );

        return view('perlengkapan.show', compact('perlengkapan'));
    }

    // Menampilkan form edit perlengkapan
    public function edit(Perlengkapan $perlengkapan)
    {
        $perlengkapan = $this->perlengkapanService->findById(
            $perlengkapan->id
        );

        return view('perlengkapan.edit', compact('perlengkapan'));
    }

    // Memperbarui data perlengkapan
    public function update(
        UpdatePerlengkapanRequest $request,
        Perlengkapan $perlengkapan
    ) {
        $this->perlengkapanService->update(
            $perlengkapan->id,
            $request->validated()
        );

        return redirect()
            ->route('perlengkapan.index')
            ->with('success', 'Data perlengkapan berhasil diperbarui.');
    }

    // Menghapus data perlengkapan
    public function destroy(Perlengkapan $perlengkapan)
    {
        $this->perlengkapanService->delete($perlengkapan->id);

        return redirect()
            ->route('perlengkapan.index')
            ->with('success', 'Data perlengkapan berhasil dihapus.');
    }
}