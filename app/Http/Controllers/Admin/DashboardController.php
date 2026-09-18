<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Kontak;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Fasilitas;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGuru = Guru::count();

        // Tabel siswa hanya memiliki kolom total_siswa
        $totalSiswa = Siswa::value('total_siswa') ?? 0;

        $totalJurusan = Jurusan::count();

        $totalEkskul = Ekstrakurikuler::count();

        $totalArtikel = Artikel::count();

        $totalGaleri = Galeri::count();

        $totalPesan = Kontak::count();

        $totalFasilitas = Fasilitas::count();

        return view('admin.dashboard', compact(
            'totalGuru',
            'totalSiswa',
            'totalJurusan',
            'totalEkskul',
            'totalArtikel',
            'totalGaleri',
            'totalPesan',
            'totalFasilitas'
        ));
    }
}
