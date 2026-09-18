
@extends('layouts.app')

@section('title', 'Berita & Kegiatan - SMK Negeri 1 Cijati')

@section('content')

<link rel="stylesheet" href="{{ asset('css/artikel.css') }}">

{{-- =========================================================
     PAGE HEADER
========================================================= --}}

<section class="page-header">

    <div class="container">

        <h1>
            Berita & Kegiatan
        </h1>

        <p>
            Informasi terbaru dan kegiatan
            SMK Negeri 1 Cijati
        </p>

    </div>

</section>


{{-- =========================================================
     BERITA & KEGIATAN SEKOLAH
========================================================= --}}

<section class="section container berita-section">

    {{-- =====================================================
         HEADER SECTION
    ====================================================== --}}

    <div class="jurusan-heading">

        <span class="section-label">
            INFORMASI TERBARU
        </span>

        <h2>
            Berita & Kegiatan Sekolah
        </h2>

        <p>
            Informasi terbaru mengenai berita,
            kegiatan, dan berbagai aktivitas
            SMK Negeri 1 Cijati.
        </p>

    </div>


    {{-- =====================================================
         GRID BERITA
    ====================================================== --}}

    <div class="news-grid">

        @forelse ($artikel as $item)

            <a
                href="{{ route('artikel.detail', $item->slug) }}"
                class="news-card"
            >

                {{-- =================================================
                     GAMBAR BERITA
                ================================================== --}}

                <div class="news-thumb">

                    @if ($item->gambar)

                        <img
                            src="{{ asset('image/artikel/' . $item->gambar) }}"
                            alt="{{ $item->judul }}"
                            loading="lazy"
                        >

                    @else

                        <img
                            src="{{ asset('image/placeholder.jpg') }}"
                            alt="Berita"
                            loading="lazy"
                        >

                    @endif


                    {{-- KATEGORI --}}

                    @if ($item->kategori)

                        <span class="news-badge">

                            {{ $item->kategori->nama_kategori }}

                        </span>

                    @endif

                </div>


                {{-- =================================================
                     ISI BERITA
                ================================================== --}}

                <div class="news-body">

                    <span class="news-date">

                        <i class="bi bi-calendar3"></i>

                        {{ $item->tanggal_publish
                            ? \Carbon\Carbon::parse($item->tanggal_publish)
                                ->translatedFormat('d M Y')
                            : '-'
                        }}

                    </span>


                    <h3>
                        {{ $item->judul }}
                    </h3>


                    <p>
                        {{ \Illuminate\Support\Str::limit(
                            $item->isi,
                            120
                        ) }}
                    </p>

                </div>

            </a>

        @empty

            {{-- =================================================
                 DATA KOSONG
            ================================================== --}}

            <div class="empty-content">

                <i class="bi bi-newspaper"></i>

                <h3>
                    Belum Ada Berita
                </h3>

                <p>
                    Data berita dan kegiatan sekolah
                    belum tersedia.
                </p>

            </div>

        @endforelse

    </div>

</section>

@endsection

