@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-header">

    <div>

        <h1>
            Dashboard
        </h1>

        <p>
            Ringkasan data SMK Negeri 1 Cijati
        </p>

    </div>

</div>


<div class="row g-4">

    {{-- GURU --}}
    <div class="col-xl-3 col-md-6">

        <div class="admin-stat-card">

            <div class="stat-icon blue">
                <i class="bi bi-person-workspace"></i>
            </div>

            <div>

                <span class="stat-label">
                    Guru
                </span>

                <h2>
                    {{ $totalGuru }}
                </h2>

            </div>

        </div>

    </div>


    {{-- SISWA --}}
    <div class="col-xl-3 col-md-6">

        <div class="admin-stat-card">

            <div class="stat-icon green">
                <i class="bi bi-people-fill"></i>
            </div>

            <div>

                <span class="stat-label">
                    Total Siswa
                </span>

                <h2>
                    {{ $totalSiswa }}
                </h2>

            </div>

        </div>

    </div>


    {{-- JURUSAN --}}
    <div class="col-xl-3 col-md-6">

        <div class="admin-stat-card">

            <div class="stat-icon orange">
                <i class="bi bi-mortarboard-fill"></i>
            </div>

            <div>

                <span class="stat-label">
                    Jurusan
                </span>

                <h2>
                    {{ $totalJurusan }}
                </h2>

            </div>

        </div>

    </div>


    {{-- EKSTRAKURIKULER --}}
    <div class="col-xl-3 col-md-6">

        <div class="admin-stat-card">

            <div class="stat-icon purple">
                <i class="bi bi-trophy-fill"></i>
            </div>

            <div>

                <span class="stat-label">
                    Ekstrakurikuler
                </span>

                <h2>
                    {{ $totalEkskul }}
                </h2>

            </div>

        </div>

    </div>

{{-- Fasilitas --}}
<div class="col-xl-3 col-md-6">

    <div class="admin-stat-card">

        <div class="stat-icon purple">
            <i class="bi bi-building-fill"></i>
        </div>

        <div>

            <span class="stat-label">
                Fasilitas
            </span>

            <h2>
                {{ $totalFasilitas }}
            </h2>

        </div>

    </div>

</div>



    {{-- ARTIKEL --}}
    <div class="col-xl-3 col-md-6">

        <div class="admin-stat-card">

            <div class="stat-icon red">
                <i class="bi bi-newspaper"></i>
            </div>

            <div>

                <span class="stat-label">
                    Artikel
                </span>

                <h2>
                    {{ $totalArtikel }}
                </h2>

            </div>

        </div>

    </div>


    {{-- GALERI --}}
    <div class="col-xl-3 col-md-6">

        <div class="admin-stat-card">

            <div class="stat-icon cyan">
                <i class="bi bi-images"></i>
            </div>

            <div>

                <span class="stat-label">
                    Galeri
                </span>

                <h2>
                    {{ $totalGaleri }}
                </h2>

            </div>

        </div>

    </div>


    {{-- PESAN --}}
    <div class="col-xl-3 col-md-6">

        <div class="admin-stat-card">

            <div class="stat-icon yellow">
                <i class="bi bi-envelope-fill"></i>
            </div>

            <div>

                <span class="stat-label">
                    Pesan
                </span>

                <h2>
                    {{ $totalPesan }}
                </h2>

            </div>

        </div>

    </div>

</div>

@endsection