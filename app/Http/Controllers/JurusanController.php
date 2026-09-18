<?php

namespace App\Http\Controllers;
use App\Models\Jurusan;

class JurusanController extends Controller
{ 
    public function jurusan()
{
    $jurusans = Jurusan::all(); // ambil semua data, tanpa limit

    return view('jurusan.jurusan', compact('jurusans'));
}
}