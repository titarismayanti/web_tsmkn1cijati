@extends('layouts.app')

@section('title', 'Guru - SMK Negeri 1 Cijati')

@section('content')

<link rel="stylesheet" href="{{ asset('css/guru.css') }}">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


{{-- =========================================================
     HEADER HALAMAN
========================================================= --}}

<section class="page-header">

    <div class="container">

        <h1>Guru & Tenaga Pendidik</h1>

        <p>
            Mengenal tenaga pendidik yang berperan dalam
            membimbing dan mengembangkan potensi siswa.
        </p>

    </div>

</section>


{{-- =========================================================
     KONTEN GURU
========================================================= --}}

<section class="section container">


    {{-- =====================================================
         JUDUL BAGIAN
    ====================================================== --}}

    <div class="guru-heading">

        <h2>Tenaga Pendidik</h2>

        <p>
            Daftar guru dan tenaga pendidik
            SMK Negeri 1 Cijati.
        </p>

    </div>


    {{-- =====================================================
         KEPALA SEKOLAH
    ====================================================== --}}

    @if($kepsek)

        <div class="kepsek-card">

            {{-- FOTO KEPALA SEKOLAH --}}

            <div class="kepsek-photo">

                <img
                    src="{{ asset('image/kepsek.jpg') }}"
                    alt="Kepala Sekolah {{ $kepsek->nama_guru }}"
                    loading="lazy"
                >

            </div>


            {{-- INFORMASI --}}

            <div class="kepsek-info">

                <span class="kepsek-label">
                    KEPALA SEKOLAH
                </span>

                <h3>
                    {{ $kepsek->nama_guru }}
                </h3>

                <p>
                    {{ $kepsek->jabatan }}
                </p>

            </div>

        </div>

    @endif


    {{-- =====================================================
         DAFTAR GURU
    ====================================================== --}}

    <div class="guru-list-heading">

        <h3>Daftar Guru</h3>

    </div>


    <div class="guru-grid">

        @forelse($guru as $g)

            <article class="guru-card">

                {{-- IKON JENIS KELAMIN --}}

                <div class="gender-icon">

                    @if($g->jenis_kelamin == 'L')

                        <i class="fas fa-mars"></i>

                    @elseif($g->jenis_kelamin == 'P')

                        <i class="fas fa-venus"></i>

                    @else

                        <i class="fas fa-user"></i>

                    @endif

                </div>


                {{-- NAMA GURU --}}

                <h4>
                    {{ $g->nama_guru }}
                </h4>


                {{-- JABATAN --}}

                <p>
                    {{ $g->jabatan }}
                </p>

            </article>

        @empty

            <div class="guru-empty">

                <i class="fas fa-user-tie"></i>

                <p>
                    Data guru belum tersedia.
                </p>

            </div>

        @endforelse

    </div>

</section>

@endsection