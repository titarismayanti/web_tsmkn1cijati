<?php

namespace App\Http\Controllers;

use App\Models\Guru;

class GuruController extends Controller
{
public function index()
{
    // Ambil Kepala Sekolah
    $kepsek = Guru::where('jabatan', 'Kepala Sekolah')->first();

    // Ambil guru selain Kepala Sekolah
    $guru = Guru::where('jabatan', '!=', 'Kepala Sekolah')->get();

    return view('profil.Guru', compact('kepsek', 'guru'));
}
}