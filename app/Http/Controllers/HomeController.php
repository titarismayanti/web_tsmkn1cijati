<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Ekstrakurikuler;
use App\Models\Jurusan;
use App\Models\ProfilSekolah;

class HomeController extends Controller
{
    public function index()
    {
        // ========================================
        // PROFIL SEKOLAH
        // ========================================

        $profil = ProfilSekolah::first();


        // ========================================
        // STATISTIK
        // ========================================

        $totalGuru = Guru::count();

        $totalSiswa = Siswa::value('total_siswa') ?? 0;

        $totalEkskul = Ekstrakurikuler::count();

        $totalJurusan = Jurusan::count();


        // ========================================
        // BERITA & KEGIATAN
        // ========================================

        $berita = Artikel::latest('tanggal_publish')
            ->take(6)
            ->get();


        // ========================================
        // GALERI PRESTASI
        // ========================================

        $galeri = Galeri::query()
            ->orderByDesc('tanggal_publish')
            ->take(3)
            ->get();


        // ========================================
        // EKSTRAKURIKULER
        // ========================================

        $ekstrakurikulers = Ekstrakurikuler::latest()
            ->take(4)
            ->get();


        // ========================================
        // JURUSAN
        // ========================================

        $jurusans = Jurusan::latest()
            ->get();


        // ========================================
        // KEPALA SEKOLAH
        // ========================================

        $kepsek = Guru::where(
            'jabatan',
            'Kepala Sekolah'
        )->first();


        // ========================================
        // GURU LAINNYA
        // ========================================

        $guru = Guru::where(
            'jabatan',
            '!=',
            'Kepala Sekolah'
        )->get();


        // ========================================
        // HOME
        // ========================================

        return view('home.Home', [

            'title' => 'Beranda',

            // Profil Sekolah
            'profil' => $profil,

            // Berita
            'berita' => $berita,

            // Galeri Prestasi
            'galeri' => $galeri,

            // Statistik
            'totalGuru' => $totalGuru,
            'totalSiswa' => $totalSiswa,
            'totalEkskul' => $totalEkskul,
            'totalJurusan' => $totalJurusan,

            // Ekstrakurikuler
            'ekstrakurikulers' => $ekstrakurikulers,

            // Jurusan
            'jurusans' => $jurusans,

            // Guru
            'kepsek' => $kepsek,
            'guru' => $guru,

        ]);
    }
}