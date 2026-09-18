<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class GaleriController extends Controller
{

    public function index()
    {
        $galeri = Galeri::query()
            ->orderByDesc('tanggal_publish')
            ->paginate(10);

        return view('galeri.Galeri', compact('galeri'));
    }
}
