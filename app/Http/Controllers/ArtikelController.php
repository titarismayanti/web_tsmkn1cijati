<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\ArtikelKategori;

class ArtikelController extends Controller
{
    /**
     * Menampilkan semua artikel yang sudah dipublikasikan.
     */
    public function index()
    {
        $artikel = Artikel::query()
            ->with('kategori')
            ->whereNotNull('tanggal_publish')
            ->orderBy('tanggal_publish', 'desc')
            ->get();

        $kategori = ArtikelKategori::query()
            ->orderBy('nama_kategori', 'asc')
            ->get();

        return view('artikel.Artikel', [
            'title' => 'Berita & Kegiatan Sekolah',
            'artikel' => $artikel,
            'kategori' => $kategori,
            'aktif' => null,
        ]);
    }

    /**
     * Menampilkan artikel berdasarkan kategori.
     */
    public function kategori($slug)
    {
        $kategori = ArtikelKategori::query()
            ->orderBy('nama_kategori', 'asc')
            ->get();

        $kategoriAktif = ArtikelKategori::query()
            ->where('slug', $slug)
            ->first();

        if (!$kategoriAktif) {
            abort(404);
        }

        $artikel = Artikel::query()
            ->with('kategori')
            ->where('kategori_artikel_id', $kategoriAktif->id)
            ->whereNotNull('tanggal_publish')
            ->orderBy('tanggal_publish', 'desc')
            ->get();

        return view('artikel.Artikel', [
            'title' => 'Berita & Kegiatan Sekolah',
            'artikel' => $artikel,
            'kategori' => $kategori,
            'aktif' => $slug,
        ]);
    }

    /**
     * Menampilkan detail artikel berdasarkan slug.
     */
    public function detail($slug)
    {
        $item = Artikel::query()
            ->with('kategori')
            ->where('slug', $slug)
            ->whereNotNull('tanggal_publish')
            ->first();

        if (!$item) {
            abort(404);
        }

        $item->increment('dilihat');

        return view('artikel.Detailartikel', [
            'title' => $item->judul,
            'item' => $item,
        ]);
    }
}