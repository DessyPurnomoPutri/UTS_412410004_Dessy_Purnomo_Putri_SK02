<?php

namespace App\Http\Controllers;

use App\Models\KegiatanObservasi;
use Illuminate\Http\Request;

class PublicKegiatanObservasiController extends Controller
{
    // Menampilkan daftar kegiatan publik
    public function index(Request $request)
    {
        $search = $request->input('search');

        $kegiatans = KegiatanObservasi::with('lokasi')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_kegiatan', 'like', '%' . $search . '%')
                      ->orWhere('target_pengamatan', 'like', '%' . $search . '%')
                      ->orWhereHas('lokasi', function ($lokasiQuery) use ($search) {
                          $lokasiQuery->where('nama_lokasi', 'like', '%' . $search . '%');
                      });
                });
            })
            ->latest()
            ->get();

        return view('public.kegiatan.index', compact('kegiatans'));
    }

    // Menampilkan detail kegiatan publik
    public function show($id)
    {
        $kegiatan = KegiatanObservasi::with('lokasi')
            ->findOrFail($id);

        return view('public.kegiatan.show', compact('kegiatan'));
    }
}
