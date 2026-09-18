<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DataSekolahController;



// ================= HOME ==============

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


// ============== PROFIL ===============
Route::get('/profil', [ProfilController::class, 'index'])
    ->name('profil');

Route::get('/profil/guru', [GuruController::class, 'index'])
    ->name('profil.guru');

Route::get('/profil/fasilitas', [ProfilController::class, 'fasilitas'])
    ->name('profil.fasilitas');


// ========== EKSTRAKURIKULER ===============

Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])
    ->name('ekstrakurikuler');

// ==========GALERI ====================

// ===============KONSENTRASI KEAHLIAN =======================

Route::get('/konsentrasi-keahlian', [JurusanController::class, 'jurusan'])
    ->name('jurusan.jurusan');


// ================== ARTIKEL ====================

// Semua artikel
Route::get('/artikel', [ArtikelController::class, 'index'])
    ->name('artikel');

// Detail artikel
Route::get('/artikel/{slug}', [ArtikelController::class, 'detail'])
    ->name('artikel.detail');

// =============== BERITA ==================

// Alias untuk halaman kategori Berita
Route::get('/berita', function () {

    $kategori = \App\Models\ArtikelKategori::where(
        'nama_kategori',
        'Berita'
    )->firstOrFail();

    return redirect()->route(
        'artikel.kategori',
        $kategori->id
    );

})->name('berita');

// =============== GALERI ==================

Route::get('/galeri', [GaleriController::class, 'index'])
    ->name('galeri');

// =============== FASILITAS ==================

Route::get('/fasilitas', [FasilitasController::class, 'index'])
    ->name('fasilitas');

// ============== KONTAK ===================

Route::get('/kontak', [KontakController::class, 'index'])
    ->name('kontak');

Route::post('/kontak', [KontakController::class, 'store'])
    ->name('kontak.store');

// ============== ADMIN ===================

Route::get('/admin/login', [AuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AuthController::class, 'login'])
    ->name('admin.login.process');

Route::post('/admin/logout', [AuthController::class, 'logout'])
    ->name('admin.logout');

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/login', [
            AuthController::class,
            'showLogin'
        ])->name('login');

        Route::post('/login', [
            AuthController::class,
            'login'
        ])->name('login.process');

        Route::post('/logout', [
            AuthController::class,
            'logout'
        ])->name('logout');

        Route::middleware('admin')->group(function () {

            Route::get('/dashboard', [
                DashboardController::class,
                'index'
            ])->name('dashboard');

        });

    });


    Route::prefix('admin')->name('admin.')->group(function () {

    // HALAMAN
    Route::get('/guru', [DataSekolahController::class, 'guru'])
        ->name('guru');

    Route::get('/siswa', [DataSekolahController::class, 'siswa'])
        ->name('siswa');

    Route::get('/jurusan', [DataSekolahController::class, 'jurusan'])
        ->name('jurusan');

    Route::get('/ekstrakurikuler', [DataSekolahController::class, 'ekstrakurikuler'])
        ->name('ekstrakurikuler');

    Route::get('/artikel', [DataSekolahController::class, 'artikel'])
        ->name('artikel');

    Route::get('/galeri', [DataSekolahController::class, 'galeri'])
        ->name('galeri');

    Route::get('/kontak', [DataSekolahController::class, 'kontak'])
        ->name('kontak');

    Route::get('/fasilitas', [DataSekolahController::class, 'fasilitas'])
        ->name('fasilitas');

    Route::get('/profil', [DataSekolahController::class, 'profil'])
    ->name('profil');

    Route::put('/profil', [DataSekolahController::class, 'updateProfil'])
    ->name('profil.update');

    // GURU
    Route::post('/guru', [DataSekolahController::class, 'storeGuru'])
        ->name('guru.store');

    Route::put('/guru/{guru}', [DataSekolahController::class, 'updateGuru'])
        ->name('guru.update');

    Route::delete('/guru/{guru}', [DataSekolahController::class, 'destroyGuru'])
        ->name('guru.destroy');


    // SISWA
    Route::post('/siswa', [DataSekolahController::class, 'storeSiswa'])
        ->name('siswa.store');

    Route::put('/siswa/{siswa}', [DataSekolahController::class, 'updateSiswa'])
        ->name('siswa.update');

    Route::delete('/siswa/{siswa}', [DataSekolahController::class, 'destroySiswa'])
        ->name('siswa.destroy');


    // JURUSAN
    Route::post('/jurusan', [DataSekolahController::class, 'storeJurusan'])
        ->name('jurusan.store');

    Route::put('/jurusan/{jurusan}', [DataSekolahController::class, 'updateJurusan'])
        ->name('jurusan.update');

    Route::delete('/jurusan/{jurusan}', [DataSekolahController::class, 'destroyJurusan'])
        ->name('jurusan.destroy');


    // EKSTRAKURIKULER
    Route::post('/ekstrakurikuler', [DataSekolahController::class, 'storeEkstrakurikuler'])
        ->name('ekstrakurikuler.store');

    Route::put('/ekstrakurikuler/{ekstrakurikuler}', [DataSekolahController::class, 'updateEkstrakurikuler'])
        ->name('ekstrakurikuler.update');

    Route::delete('/ekstrakurikuler/{ekstrakurikuler}', [DataSekolahController::class, 'destroyEkstrakurikuler'])
        ->name('ekstrakurikuler.destroy');

     // ARTIKEL
    Route::post('/artikel', [DataSekolahController::class, 'storeArtikel'])
        ->name('artikel.store');

    Route::put('/artikel/{artikel}', [DataSekolahController::class, 'updateArtikel'])
        ->name('artikel.update');

    Route::delete('/artikel/{artikel}', [DataSekolahController::class, 'destroyArtikel'])
        ->name('artikel.destroy');

     //GALERI
    Route::get('/galeri', [DataSekolahController::class, 'galeri'])
    ->name('galeri');

    Route::post('/galeri', [DataSekolahController::class, 'storeGaleri'])
    ->name('galeri.store');

    Route::put('/galeri/{galeri}', [DataSekolahController::class, 'updateGaleri'])
    ->name('galeri.update');

    Route::delete('/galeri/{galeri}', [DataSekolahController::class, 'destroyGaleri'])
    ->name('galeri.destroy');

    //KONTAK
    Route::get('/kontak', [DataSekolahController::class, 'kontak'])
    ->name('kontak');

    Route::post('/kontak', [DataSekolahController::class, 'storeKontak'])
    ->name('kontak.store');

    Route::put('/kontak/{kontak}', [DataSekolahController::class, 'updateKontak'])
    ->name('kontak.update');

    Route::delete('/kontak/{kontak}', [DataSekolahController::class, 'destroyKontak'])
    ->name('kontak.destroy');

     //FASILITAS
    Route::get('/fasilitas', [DataSekolahController::class, 'fasilitas'])
    ->name('fasilitas');

    Route::post('/fasilitas', [DataSekolahController::class, 'storeFasilitas'])
    ->name('fasilitas.store');

    Route::put('/fasilitas/{fasilitas}', [DataSekolahController::class, 'updateFasilitas'])
    ->name('fasilitas.update');

    Route::delete('/fasilitas/{fasilitas}', [DataSekolahController::class, 'destroyFasilitas'])
    ->name('fasilitas.destroy');

});
