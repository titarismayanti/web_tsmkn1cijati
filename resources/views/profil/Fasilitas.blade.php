@extends('layouts.app')

@section('title', 'Fasilitas Sekolah - SMK Negeri 1 Cijati')

@section('content')

<link rel="stylesheet" href="{{ asset('css/fasilitas.css') }}">

{{-- =========================================================
HEADER HALAMAN
========================================================= --}}

<section class="page-header">

<div class="container">

    <h1>Fasilitas Sekolah</h1>

    <p>
        Sarana dan prasarana yang mendukung
        kegiatan belajar mengajar.
    </p>

</div>


</section>

{{-- =========================================================
KONTEN FASILITAS
========================================================= --}}

<section class="section container fasilitas-section">


{{-- JUDUL BAGIAN --}}

<div class="fasilitas-heading">

    <h2>Fasilitas Sekolah</h2>

    <p>
        Berbagai fasilitas yang tersedia untuk menunjang
        kegiatan belajar, mengajar, dan aktivitas siswa.
    </p>

</div>


{{-- =====================================================
     GRID FASILITAS
====================================================== --}}

<div class="fasilitas-grid">

    @forelse ($fasilitas as $item)

        <article class="fasilitas-card">

            {{-- FOTO FASILITAS --}}

            <div class="fasilitas-thumb">

                @if (!empty($item->gambar))

                    <img
                        src="{{ asset('image/fasilitas/' . $item->gambar) }}"
                        alt="{{ $item->nama_fasilitas }}"
                        loading="lazy"
                    >

                @else

                    <img
                        src="{{ asset('image/placeholder.jpg') }}"
                        alt="{{ $item->nama_fasilitas }}"
                        loading="lazy"
                    >

                @endif

            </div>


            {{-- INFORMASI FASILITAS --}}

            <div class="fasilitas-body">

                <h3>
                    {{ $item->nama_fasilitas }}
                </h3>

            </div>

        </article>

    @empty

        {{-- DATA KOSONG --}}

        <div class="fasilitas-empty">

            <i class="bi bi-building"></i>

            <p>
                Belum ada data fasilitas.
            </p>

        </div>

    @endforelse

</div>


</section>

@endsection
