<?php

namespace App\Http\Controllers;

use App\Models\Perlengkapan;
use Illuminate\Http\Request;

class PublicPerlengkapanController extends Controller
{
    // Menampilkan daftar perlengkapan publik
    public function index(Request $request)
    {
        $search = $request->input('search');

        $perlengkapans = Perlengkapan::where('kondisi', 'baik')
            ->where('jumlah', '>', 0)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_perlengkapan', 'like', '%' . $search . '%')
                      ->orWhere('kode_perlengkapan', 'like', '%' . $search . '%')
                      ->orWhere('kategori', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('nama_perlengkapan')
            ->get();

        return view('public.perlengkapan.index', compact('perlengkapans'));
    }

    // Menampilkan detail perlengkapan publik
    public function show($id)
    {
        $perlengkapan = Perlengkapan::findOrFail($id);

        return view('public.perlengkapan.show', compact('perlengkapan'));
    }
}
