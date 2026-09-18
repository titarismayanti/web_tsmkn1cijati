<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    /**
     * Menampilkan halaman fasilitas sekolah.
     */
    public function index()
    {
        $fasilitas = Fasilitas::latest('id')->get();

        return view('profil.Fasilitas', compact('fasilitas'));
    }
}
