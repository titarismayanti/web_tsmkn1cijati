@extends('layouts.app')

@section('title', 'Galeri Prestasi - SMK Negeri 1 Cijati')

@section('content')

<link rel="stylesheet" href="{{ asset('css/galeri.css') }}">

<section class="page-header">

<div class="container">

    <h1>Galeri Prestasi</h1>

    <p>
        Dokumentasi berbagai prestasi dan pencapaian
        SMK Negeri 1 Cijati.
    </p>

</div>


</section>

<section class="section container galeri-page">

<div class="galeri-heading">

    <h2>Prestasi Sekolah</h2>

    <p>
        Dokumentasi berbagai prestasi dan pencapaian
        sekolah yang telah diraih.
    </p>

</div>


@if ($galeri->count())

    <div class="prestasi-grid">

        @foreach ($galeri as $item)

            <article class="prestasi-card">

                <div class="prestasi-image">

                    @if ($item->gambar)

                        <img
                            src="{{ asset('image/galeri/' . $item->gambar) }}"
                            alt="{{ $item->judul }}"
                            loading="lazy"
                        >

                    @else

                        <div class="prestasi-no-image">

                            <i class="bi bi-image"></i>

                            <span>Foto belum tersedia</span>

                        </div>

                    @endif

                </div>


                <div class="prestasi-content">

                    @if ($item->tanggal_publish)

                        <span class="prestasi-date">

                            <i class="bi bi-calendar3"></i>

                            {{ $item->tanggal_publish->translatedFormat('d M Y') }}

                        </span>

                    @endif


                    <h3>
                        {{ $item->judul }}
                    </h3>


                    @if ($item->deskripsi)

                        <p>
                            {{ $item->deskripsi }}
                        </p>

                    @endif

                </div>

            </article>

        @endforeach

    </div>


    @if (method_exists($galeri, 'links'))

        <div class="galeri-pagination">

            {{ $galeri->links() }}

        </div>

    @endif


@else

    <div class="prestasi-empty">

        <div class="empty-icon">

            <i class="bi bi-trophy"></i>

        </div>

        <h3>
            Belum Ada Prestasi
        </h3>

        <p>
            Data galeri prestasi sekolah belum tersedia.
        </p>

    </div>

@endif


</section>

@endsection
