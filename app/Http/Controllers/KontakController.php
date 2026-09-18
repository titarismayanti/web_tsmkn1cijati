<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;

class KontakController extends Controller
{
 public function index()
{
    $profil = ProfilSekolah::first();

    return view('kontak.kontak', compact('profil'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string',
        ]);

        Kontak::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Pesan berhasil dikirim!');
    }
}
