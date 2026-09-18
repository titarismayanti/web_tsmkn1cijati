@extends('layouts.app')

@section('title', 'Konsentrasi Keahlian - SMK Negeri 1 Cijati')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jurusan.css') }}">

{{-- =========================================================
     HEADER HALAMAN
========================================================= --}}

<section class="page-header">
    <div class="container">

        <h1>Konsentrasi Keahlian</h1>

        <p>
            Pilihan konsentrasi keahlian untuk mengembangkan
            kompetensi dan keterampilan siswa.
        </p>

    </div>
</section>


{{-- =========================================================
     KONTEN JURUSAN
========================================================= --}}

<section class="section container">

    {{-- JUDUL BAGIAN --}}

    <div class="jurusan-heading">

        <div>
            <h2>Program Pendidikan</h2>

            <p>
                Kenali berbagai konsentrasi keahlian
                yang tersedia di SMK Negeri 1 Cijati.
            </p>
        </div>

    </div>


    {{-- GRID JURUSAN --}}

    <div class="keahlian-grid">

        @forelse ($jurusans as $jurusan)

            <article class="keahlian-card">

                {{-- =================================================
                     LOGO / GAMBAR JURUSAN
                ================================================= --}}

                <div class="keahlian-photo">

                    <div class="keahlian-logo">

                        @if (!empty($jurusan->gambar))

                            <img
                                src="{{ asset('image/jurusan/' . $jurusan->gambar) }}"
                                alt="{{ $jurusan->singkatan ?? $jurusan->nama_jurusan }}"
                                loading="lazy"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            >

                            <span
                                class="keahlian-logo-fallback"
                                style="display: none;"
                            >
                                {{ $jurusan->singkatan ?? 'J' }}
                            </span>

                        @else

                            <span class="keahlian-logo-fallback">
                                {{ $jurusan->singkatan ?? 'J' }}
                            </span>

                        @endif

                    </div>


                    {{-- SINGKATAN --}}

                    @if (!empty($jurusan->singkatan))

                        <span class="keahlian-singkatan">
                            {{ $jurusan->singkatan }}
                        </span>

                    @endif

                </div>


                {{-- =================================================
                     INFORMASI JURUSAN
                ================================================= --}}

                <div class="keahlian-content">

                    <h3>
                        {{ $jurusan->nama_jurusan }}
                    </h3>


                    {{-- KEPALA PROGRAM --}}

                    <p class="keahlian-kaprog">

                        <i class="bi bi-person-badge-fill"></i>

                        Kepala Program:
                        {{ $jurusan->kepalaProgram->nama_guru ?? 'Belum ditentukan' }}

                    </p>


                    {{-- DESKRIPSI --}}

                    <p class="keahlian-description">

                        {{ \Illuminate\Support\Str::limit(
                            $jurusan->deskripsi ?? 'Program keahlian SMK Negeri 1 Cijati.',
                            100
                        ) }}

                    </p>

                </div>

            </article>

        @empty

            {{-- DATA KOSONG --}}

            <div class="keahlian-empty">

                <i class="bi bi-mortarboard"></i>

                <p>
                    Data konsentrasi keahlian belum tersedia.
                </p>

            </div>

        @endforelse

    </div>

</section>

@endsection