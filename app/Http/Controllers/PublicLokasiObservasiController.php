<?php

namespace App\Http\Controllers;

use App\Models\LokasiObservasi;
use Illuminate\Http\Request;

class PublicLokasiObservasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $lokasis = LokasiObservasi::when($search, function ($query, $search) {
            $query->where('nama_lokasi', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%');
        })
        ->latest()
        ->get();

        return view('public.lokasi.index', compact('lokasis'));
    }

    public function show($id)
    {
        $lokasi = LokasiObservasi::findOrFail($id);

        return view('public.lokasi.show', compact('lokasi'));
    }
}
