
@extends('layouts.app')

@section('title', 'Ekstrakurikuler - SMK Negeri 1 Cijati')

@section('content')

<link rel="stylesheet" href="{{ asset('css/eskul.css') }}">

{{-- =========================================================
     PAGE HEADER
========================================================= --}}

<section class="page-header">
    <div class="container">

        <h1>Ekstrakurikuler</h1>

        <p>
            Mengenal berbagai kegiatan ekstrakurikuler
            di SMK Negeri 1 Cijati
        </p>

    </div>
</section>


{{-- =========================================================
     KONTEN EKSTRAKURIKULER
========================================================= --}}

<section class="section container">

    <div class="jurusan-heading">

        <span class="section-label">
            KEGIATAN SISWA
        </span>

        <h2>
            Semua Ekstrakurikuler
        </h2>

        <p>
            Daftar lengkap ekstrakurikuler yang tersedia
            di SMK Negeri 1 Cijati.
        </p>

    </div>


    {{-- =====================================================
         GRID EKSTRAKURIKULER
    ====================================================== --}}

    <div class="keahlian-grid">

        @forelse ($ekstrakurikulers as $ekskul)

            <article class="keahlian-card">

                {{-- FOTO / LOGO --}}
                <div class="keahlian-photo">

                    <div class="keahlian-logo">

                        @if (!empty($ekskul->logo))

                            <img
                                src="{{ asset('image/ekskul/' . $ekskul->logo) }}"
                                alt="{{ $ekskul->nama_eskul }}"
                                loading="lazy"
                                onerror="
                                    this.style.display='none';
                                    this.nextElementSibling.style.display='flex';
                                "
                            >

                            <span
                                class="keahlian-logo-fallback"
                                style="display: none;"
                            >
                                {{ strtoupper(substr($ekskul->nama_eskul, 0, 2)) }}
                            </span>

                        @else

                            <span class="keahlian-logo-fallback">
                                {{ strtoupper(substr($ekskul->nama_eskul, 0, 2)) }}
                            </span>

                        @endif

                    </div>

                </div>


                {{-- CONTENT --}}
                <div class="keahlian-content">

                    {{-- NAMA EKSTRAKURIKULER --}}
                    <h3>
                        {{ $ekskul->nama_eskul }}
                    </h3>


                    {{-- PEMBINA --}}
                    <p class="keahlian-kaprog">
                        <i class="bi bi-person-fill"></i>
                        Pembina:
                        {{ $ekskul->guru->nama_guru ?? '-' }}
                    </p>


                    {{-- DESKRIPSI --}}
                    <p class="keahlian-description">
                        {{ \Illuminate\Support\Str::limit(
                            $ekskul->deskripsi ?? 'Belum ada deskripsi.',
                            100
                        ) }}
                    </p>

                </div>

            </article>

        @empty

            <div class="keahlian-empty">

                <i class="bi bi-trophy"></i>

                <p>
                    Data ekstrakurikuler belum tersedia.
                </p>

            </div>

        @endforelse

    </div>

</section>

@endsection

