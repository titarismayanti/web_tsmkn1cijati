<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;

class EkstrakurikulerController extends Controller
{
    /**
     * Menampilkan semua data ekstrakurikuler.
     */
    public function index()
    {
$ekstrakurikulers = Ekstrakurikuler::with('guru')
    ->latest('id')
    ->get();

return view('ekstrakurikuler.Ekskul', compact('ekstrakurikulers'));
    }
}

