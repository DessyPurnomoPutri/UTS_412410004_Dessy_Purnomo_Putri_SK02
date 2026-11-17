<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Services\PesertaService;
use App\Http\Requests\StorePesertaRequest;
use App\Http\Requests\UpdatePesertaRequest;

class PesertaController extends Controller
{
    protected $pesertaService;

    public function __construct(PesertaService $pesertaService)
    {
        $this->pesertaService = $pesertaService;
    }

    // Menampilkan seluruh data peserta
    public function index()
    {
        $pesertas = $this->pesertaService->getAll(
            request()->only(['search'])
        );

        return view('peserta.index', compact('pesertas'));
    }

    // Menampilkan form tambah peserta
    public function create()
    {
        return view('peserta.create');
    }

    // Menyimpan peserta baru
    public function store(StorePesertaRequest $request)
    {
        $this->pesertaService->create($request->validated());

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil ditambahkan.');
    }

    // Menampilkan detail peserta
    public function show(Peserta $peserta)
{
    $peserta = $this->pesertaService->findById($peserta->id);

    return view('peserta.show', compact('peserta'));
}

    // Menampilkan form edit peserta
    public function edit(Peserta $peserta)
    {
        return view('peserta.edit', compact('peserta'));
    }

    // Memperbarui data peserta
    public function update(
        UpdatePesertaRequest $request,
        Peserta $peserta
    ) {
        $this->pesertaService->update(
            $peserta->id,
            $request->validated()
        );

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil diperbarui.');
    }

    // Menghapus data peserta
    public function destroy(Peserta $peserta)
    {
        $this->pesertaService->delete($peserta->id);

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil dihapus.');
    }
}
