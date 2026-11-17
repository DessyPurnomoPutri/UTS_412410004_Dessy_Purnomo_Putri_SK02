<?php

namespace App\Http\Controllers;

use App\Models\LokasiObservasi;
use App\Models\KegiatanObservasi;
use App\Models\Peserta;
use App\Models\Perlengkapan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLokasi = LokasiObservasi::count();

        $totalKegiatan = KegiatanObservasi::count();

        $totalPeserta = Peserta::count();

        $totalPerlengkapan = Perlengkapan::count();

        $kegiatanTerbaru = KegiatanObservasi::with('lokasi')
            ->latest('created_at')
            ->take(5)
            ->get();

        $kegiatanMendatang = KegiatanObservasi::with('lokasi')
            ->whereDate('tanggal_observasi', '>=', now()->toDateString())
            ->whereIn('status', ['direncanakan', 'berlangsung'])
            ->orderBy('tanggal_observasi')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalLokasi',
            'totalKegiatan',
            'totalPeserta',
            'totalPerlengkapan',
            'kegiatanTerbaru',
            'kegiatanMendatang'
        ));
    }
}
