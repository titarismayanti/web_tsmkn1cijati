<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Fasilitas;
use App\Models\Guru;

class ProfilController extends Controller
{
    /**
     * Menampilkan halaman profil sekolah.
     */
    public function index()
    {
        // Ambil satu data profil sekolah
        $profil = ProfilSekolah::first();

        return view('profil.Index', [
            'title' => 'Profil Sekolah',
            'profil' => $profil,
        ]);
    }


    /**
     * Menampilkan halaman fasilitas sekolah.
     */
    public function fasilitas()
    {
        $fasilitas = Fasilitas::latest()->get();

        return view('profil.fasilitas', [
            'title' => 'Fasilitas Sekolah',
            'fasilitas' => $fasilitas,
        ]);
    }


    /**
     * Menampilkan seluruh data guru.
     */
    public function guru()
    {
        $guru = Guru::query()
            ->orderBy('nama_guru', 'asc')
            ->get();

        return view('profil.Guru', [
            'title' => 'Data Guru & Tenaga Pendidik',
            'guru' => $guru,
        ]);
    }
}