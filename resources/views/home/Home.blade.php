<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@include('layouts.Header')


<section class="hero">
    <div class="container hero-inner">

        <h1>
            Selamat Datang di SMKN 1 CIJATI
        </h1>

        <p>
            Mencetak generasi unggul, berkarakter,
            kompeten, dan siap bersaing di era global.
        </p>
    </div>
</section>


{{-- =========================================================
     STATISTIK SEKOLAH
========================================================= --}}

<section class="stats container">

{{-- GURU --}}
    <div
        class="stat-card"
        data-target="{{ (int) $totalGuru }}">

    <div class="stat-icon">
        <i class="bi bi-person-workspace"></i>
    </div>

    <div class="stat-content">

        <span class="stat-number">
            {{ (int) $totalGuru }}
        </span>

         <span class="stat-label">
            Guru & Tenaga Pendidik
        </span>

    </div>

</div>


{{-- SISWA --}}
<div
    class="stat-card"
    data-target="{{ (int) $totalSiswa }}">

        <div class="stat-icon">
            <i class="bi bi-people-fill"></i>
        </div>

    <div class="stat-content">

        <span class="stat-number">
                {{ (int) $totalSiswa }}
        </span>

        <span class="stat-label">
                Total Siswa
        </span>
    </div>
</div>


{{-- EKSTRAKURIKULER --}}
<div
    class="stat-card"
    data-target="{{ (int) $totalEkskul }}">

    <div class="stat-icon">
        <i class="bi bi-trophy-fill"></i>
    </div>

    <div class="stat-content">

    <span class="stat-number">
        {{ (int) $totalEkskul }}
    </span>

    <span class="stat-label">
                Ekstrakurikuler
            </span>

        </div>

    </div>


    {{-- PROGRAM KEAHLIAN --}}
    <div
        class="stat-card"
        data-target="{{ (int) $totalJurusan }}"
    >

        <div class="stat-icon">
            <i class="bi bi-mortarboard-fill"></i>
        </div>

        <div class="stat-content">

            <span class="stat-number">
                {{ (int) $totalJurusan }}
            </span>

            <span class="stat-label">
                Program Keahlian
            </span>

        </div>

    </div>

</section>


{{-- =========================================================
     KONSENTRASI KEAHLIAN
========================================================= --}}

<section id="konsentrasi-keahlian" class="keahlian-section">

    <div class="container">

        {{-- =================================================
             HEADER
        ================================================== --}}

        <div class="keahlian-header">

            <div class="keahlian-title">

                <span class="section-label">
                    PROGRAM PENDIDIKAN
                </span>

                <h2>
                    Konsentrasi Keahlian
                </h2>

                <p>
                    Pilihan konsentrasi keahlian untuk mengembangkan
                    kompetensi dan keterampilan siswa.
                </p>

            </div>


            {{-- =================================================
                 TOMBOL LIHAT SEMUA
            ================================================== --}}

            <div class="keahlian-more">

                <a
                    href="{{ route('jurusan.jurusan') }}"
                    class="keahlian-all"
                >
                    <span>Lihat Semua</span>
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>


        {{-- =================================================
             DATA JURUSAN
        ================================================== --}}

        <div class="keahlian-grid">

            @forelse ($jurusans as $jurusan)

                <article class="keahlian-card">

                    {{-- =================================================
                         GAMBAR / LOGO JURUSAN
                    ================================================== --}}

                    <div class="keahlian-photo">

                        <div class="keahlian-logo">

                            @if (!empty($jurusan->gambar))

                                <img
                                    src="{{ asset('image/jurusan/' . $jurusan->gambar) }}"
                                    alt="{{ $jurusan->singkatan ?? $jurusan->nama_jurusan }}"
                                    loading="lazy"
                                    onerror="
                                        this.style.display='none';
                                        this.nextElementSibling.style.display='flex';
                                    "
                                >

                                <span
                                    class="keahlian-logo-fallback"
                                    style="display:none;"
                                >
                                    {{ $jurusan->singkatan ?: 'JP' }}
                                </span>

                            @else

                                <span class="keahlian-logo-fallback">
                                    {{ $jurusan->singkatan ?: 'JP' }}
                                </span>

                            @endif

                        </div>


                        {{-- =================================================
                             SINGKATAN
                        ================================================== --}}

                        @if (!empty($jurusan->singkatan))

                            <span class="keahlian-singkatan">
                                {{ $jurusan->singkatan }}
                            </span>

                        @endif

                    </div>


                    {{-- =================================================
                         INFORMASI JURUSAN
                    ================================================== --}}

                    <div class="keahlian-content">

                        <h3>
                            {{ $jurusan->nama_jurusan }}
                        </h3>


                        {{-- KEPALA PROGRAM --}}

                        <p class="keahlian-kaprog">

                            <i class="bi bi-person-fill"></i>

                            Kepala Program:

                            <span>
                                {{ $jurusan->kepalaProgram->nama_guru ?? 'Belum ditentukan' }}
                            </span>

                        </p>


                        {{-- DESKRIPSI --}}

                        <p class="keahlian-description">

                            {{ \Illuminate\Support\Str::limit(
                                $jurusan->deskripsi
                                    ?? 'Program keahlian SMK Negeri 1 Cijati.',
                                100
                            ) }}

                        </p>

                    </div>

                </article>

            @empty

                <div class="keahlian-empty">

                    <i class="bi bi-mortarboard-fill"></i>

                    <p>
                        Data konsentrasi keahlian belum tersedia.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>


{{-- =========================================================
     EKSTRAKURIKULER
========================================================= --}}

<section id="ekstrakurikuler" class="keahlian-section">

    <div class="container">

        {{-- =================================================
             HEADER
        ================================================== --}}

        <div class="keahlian-header">

            <div class="keahlian-title">

                <span class="section-label">
                    KEGIATAN SISWA
                </span>

                <h2>
                    Ekstrakurikuler
                </h2>

                <p>
                    Beragam kegiatan ekstrakurikuler untuk mengembangkan
                    minat, bakat, dan kreativitas siswa.
                </p>

            </div>


            {{-- =================================================
                 LIHAT SEMUA
            ================================================== --}}

            <div class="keahlian-more">

                <a
                    href="{{ route('ekstrakurikuler') }}"
                    class="keahlian-all"
                >

                    <span>
                        Lihat Semua
                    </span>

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>

        </div>


        {{-- =================================================
             DATA EKSTRAKURIKULER
        ================================================== --}}

        <div class="keahlian-grid">

            @forelse ($ekstrakurikulers as $ekskul)

                <article class="keahlian-card">

                    {{-- =================================================
                         LOGO EKSTRAKURIKULER
                    ================================================== --}}

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
                                    style="display:none;"
                                >
                                    {{ strtoupper(substr($ekskul->nama_eskul, 0, 2)) }}
                                </span>

                            @else

                                <span class="keahlian-logo-fallback">

                                    {{ strtoupper(
                                        substr($ekskul->nama_eskul, 0, 2)
                                    ) }}

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                         INFORMASI EKSTRAKURIKULER
                    ================================================== --}}

                    <div class="keahlian-content">

                        {{-- NAMA EKSTRAKURIKULER --}}

                        <h3>
                            {{ $ekskul->nama_eskul }}
                        </h3>


                        {{-- PEMBINA --}}

                        <p class="keahlian-pembina">

                            <i class="bi bi-person-fill"></i>

                            <span>Pembina:</span>

                            {{ $ekskul->guru->nama_guru ?? 'Belum ditentukan' }}

                        </p>


                        {{-- DESKRIPSI --}}

                        <p class="keahlian-description">

                            {{ \Illuminate\Support\Str::limit(
                                $ekskul->deskripsi
                                    ?? 'Kegiatan ekstrakurikuler SMK Negeri 1 Cijati.',
                                100
                            ) }}

                        </p>

                    </div>

                </article>

            @empty

                {{-- =================================================
                     DATA KOSONG
                ================================================== --}}

                <div class="keahlian-empty">

                    <i class="bi bi-trophy"></i>

                    <p>
                        Data ekstrakurikuler belum tersedia.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>



<section class="kepsek-section">

    <div class="container">

        {{-- HEADER --}}
        <div class="kepsek-header">

            <div class="kepsek-title">

                <span class="section-label">
                    TENAGA PENDIDIK
                </span>

                <h2>
                    Kepala Sekolah
                </h2>

                <p>
                    Pimpinan SMK Negeri 1 Cijati.
                </p>

            </div>


            {{-- TOMBOL LIHAT SEMUA GURU --}}
            <a
                href="{{ route('profil.guru') }}"
                class="kepsek-all"
            >
                Lihat Semua
    
            </a>

        </div>


        {{-- CARD KEPALA SEKOLAH --}}
        @if ($kepsek)

            <div class="kepsek-card">

                <div class="kepsek-photo">

                    <img
                        src="{{ asset('image/kepsek.jpg') }}"
                        alt="Kepala Sekolah {{ $kepsek->nama_guru }}"
                        loading="lazy"
                    >

                </div>


                <div class="kepsek-info">

                    <span class="kepsek-label">
                        KEPALA SEKOLAH
                    </span>

                    <h3>
                        {{ $kepsek->nama_guru }}
                    </h3>

                    <p>
                        {{ $kepsek->jabatan ?? 'Kepala Sekolah' }}
                    </p>

                </div>

            </div>

        @else

            <div class="kepsek-empty">

                <i class="bi bi-person-badge"></i>

                <p>
                    Data kepala sekolah belum tersedia.
                </p>

            </div>

        @endif

    </div>

</section>





{{-- =========================================================
BERITA & KEGIATAN SEKOLAH
========================================================= --}}

<section
    class="section berita-section"
    id="artikel"
>

<div class="container">

    {{-- =====================================================
        HEADER SECTION
    ====================================================== --}}

    <div class="section-title">

        <div class="section-heading">

            <span class="section-label">
                INFORMASI TERBARU
            </span>

            <h2>
                Berita & Kegiatan Sekolah
            </h2>

            <p class="section-description">
                Informasi terbaru mengenai berita, kegiatan,
                dan berbagai aktivitas SMK Negeri 1 Cijati.
            </p>

        </div>


<a href="{{ route('artikel') }}" class="berita-all">


<span>Lihat Semua</span>
</span>


</a>


    </div>


    {{-- =====================================================
        GRID BERITA
    ====================================================== --}}

    <div class="news-grid">

        @forelse ($berita as $item)

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


                    {{-- =================================================
                        KATEGORI
                    ================================================== --}}

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

                    {{-- TANGGAL --}}

                    <span class="news-date">

                        <i class="bi bi-calendar3"></i>

                        {{ $item->tanggal_publish
                            ? \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y')
                            : '-'
                        }}

                    </span>


                    {{-- JUDUL --}}

                    <h3>
                        {{ $item->judul }}
                    </h3>


                    {{-- DESKRIPSI --}}

                    @if ($item->isi)

                        <p>
                            {{ \Illuminate\Support\Str::limit($item->isi, 120) }}
                        </p>

                    @endif

                </div>

            </a>

        @empty

            {{-- =================================================
                DATA KOSONG
            ================================================== --}}

            <div class="empty-content">

                <div class="empty-icon">

                    <i class="bi bi-newspaper"></i>

                </div>

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

</div>


</section>


{{-- =========================================================
    GALERI PRESTASI - HOME
========================================================= --}}

<section
    class="section galeri-prestasi-section"
    id="galeri"
>

    <div class="container">

        {{-- =====================================================
            HEADER
        ===================================================== --}}

        <div class="galeri-header">

            <div class="galeri-heading">

                <span class="section-label">
                    PRESTASI SEKOLAH
                </span>

                <h2>
                    Galeri Prestasi
                </h2>

                <p class="galeri-description">
                    Dokumentasi berbagai prestasi dan pencapaian
                    sekolah.
                </p>

            </div>


            {{-- =================================================
                TOMBOL LIHAT SEMUA
            ================================================= --}}

            <div class="prestasi-action">

                <a
                    href="{{ route('galeri') }}"
                    class="btn-lihat-prestasi"
                >
                    <span class="btn-text">
                        Lihat Semua
                    </span>
                </a>

            </div>

        </div>


 
{{-- =====================================================
    GALERI PRESTASI HOME
===================================================== --}}

@if ($galeri->count() > 0)

    <div class="prestasi-home-grid">

        @foreach ($galeri->take(3) as $item)

            <article class="prestasi-home-card">

                {{-- =================================================
                    FOTO
                ================================================= --}}
                <div class="prestasi-home-image">

                    @if ($item->gambar)

                        <img
                            src="{{ asset('image/galeri/' . $item->gambar) }}"
                            alt="{{ $item->judul }}"
                            loading="lazy"
                        >

                    @else

                        <div class="prestasi-home-no-image">

                            <i class="bi bi-image"></i>

                            <span>
                                Foto belum tersedia
                            </span>

                        </div>

                    @endif

                </div>


                {{-- =================================================
                    INFORMASI PRESTASI
                ================================================= --}}
                <div class="prestasi-home-content">

                    {{-- TANGGAL --}}
                    @if ($item->tanggal_publish)

                        <span class="prestasi-home-date">

                            <i class="bi bi-calendar3"></i>

                            {{ $item->tanggal_publish->translatedFormat('d M Y') }}

                        </span>

                    @endif


                    {{-- JUDUL --}}
                    <h3>
                        {{ $item->judul }}
                    </h3>


                    {{-- DESKRIPSI --}}
                    @if ($item->deskripsi)

                        <p>
                            {{ $item->deskripsi }}
                        </p>

                    @endif

                </div>

            </article>

        @endforeach

    </div>


@else

    {{-- =================================================
        EMPTY STATE
    ================================================= --}}

    <div class="prestasi-home-empty">

        <div class="prestasi-home-empty-icon">

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
    </div>
</section>


<!-- =========================================================
     LOKASI SEKOLAH
========================================================= -->

<section class="location-section" id="lokasi">

    <div class="container">

        <div class="location-title">

            <span class="section-label">
                LOKASI SEKOLAH
            </span>

            <h2>
                Lokasi SMK Negeri 1 Cijati
            </h2>

            <p>
                Temukan lokasi SMK Negeri 1 Cijati melalui Google Maps.
            </p>

        </div>

        <div class="location-map">

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.8291230027494!2d107.0283869758611!3d-7.260279492746458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e686e4008ab702b%3A0xeae4e9c2f849b4f1!2sSMK%20Negeri%201%20Cijati!5e0!3m2!1sid!2sid!4v1788790520683!5m2!1sid!2sid"
                title="Lokasi SMK Negeri 1 Cijati di Google Maps"
                allowfullscreen
                loading="lazy"
                referrerpolicy="strict-origin-when-cross-origin">
            </iframe>

        </div>

    </div>

</section>


{{-- =========================================================
    INFORMASI SEKOLAH
========================================================= --}}
<section class="school-information">

    <div class="container">

        <div class="information-grid">


            {{-- =================================================
                KOLOM 1 - TENTANG
            ================================================== --}}
            <div class="information-card">

                <div class="information-title">

                    <i class="bi bi-info-circle-fill"></i>

                    <h2>
                        Tentang
                    </h2>

                </div>


                <div class="information-content">

                    <a
                        href="{{ url('/profil') }}"
                        class="information-button"
                    >

                        <i class="bi bi-person-fill"></i>

                        Indentitas Sekolah

                    </a>

                </div>

            </div>


            {{-- =================================================
                KOLOM 2 - WEBSITE TERKAIT
            ================================================== --}}
            <div class="information-card">

                <div class="information-title">

                    <i class="bi bi-link-45deg"></i>

                    <h2>
                        Website Terkait
                    </h2>

                </div>


                <div class="information-content">

                    <a
                        href="https://smkn1cijati.sch.id/"
                        class="information-button"
                    >

                        <i class="bi bi-book-fill"></i>

                        Graduation Annoucment

                    </a>



                </div>

            </div>


            {{-- =================================================
    KOLOM 3 - IDENTITAS SEKOLAH
================================================== --}}
<div class="information-card contact-information-card">

    <div class="school-contact">

        <div class="school-contact-logo">
            SMK
        </div>


        <h2>
            {{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}
        </h2>

    </div>


    <div class="contact-list">

        {{-- ALAMAT --}}
        <p>

            <i class="bi bi-geo-alt-fill"></i>

            <span>
                {{ $profil->alamat ?? 'Alamat belum tersedia' }}
            </span>

        </p>


        {{-- TELEPHONE --}}
        <p>

            <i class="bi bi-telephone-fill"></i>

            <span>
                {{ $profil->telephone ?? 'Telephone belum tersedia' }}
            </span>

        </p>


        {{-- EMAIL --}}
        <p>

            <i class="bi bi-envelope-fill"></i>

            <span>
                {{ $profil->email ?? 'Email belum tersedia' }}
            </span>

        </p>

    </div>

                <div class="social-links">

                    <a
                        href="https://www.facebook.com/smkn1cijatiofficial"
                        aria-label="Facebook"
                    >

                        <i class="bi bi-facebook"></i>

                    </a>


                    <a
                        href="https://www.instagram.com/smkn1cijatiofficial"
                        aria-label="Instagram"
                    >

                        <i class="bi bi-instagram"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@include('layouts.Footer')
{{-- =========================================================
    LIGHTBOX GALERI
========================================================= --}}
<div
    class="lightbox"
    id="lightbox"
>

    <span
        class="lightbox-close"
        id="lightboxClose"
    >
        &times;
    </span>


    <img
        src=""
        alt=""
        id="lightboxImg"
    >


    <p id="lightboxCaption"></p>

</div>

{{-- =========================================================
    JAVASCRIPT
========================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       COUNTER STATISTIK
    ====================================================== */

    const statCards =
        document.querySelectorAll('.stat-card');


    statCards.forEach(function (card) {

        const number =
            card.querySelector('.stat-number');


        const target =
            parseInt(card.dataset.target || 0);


        let current = 0;


        const duration = 1200;


        const increment =
            target / (duration / 20);


        function updateCounter() {

            current += increment;


            if (current >= target) {

                number.textContent =
                    target.toLocaleString('id-ID');

                return;

            }


            number.textContent =
                Math.floor(current)
                    .toLocaleString('id-ID');


            setTimeout(updateCounter, 20);

        }


        updateCounter();

    });


    /* =====================================================
       LIGHTBOX GALERI
    ====================================================== */

    const lightbox =
        document.getElementById('lightbox');


    const lightboxImg =
        document.getElementById('lightboxImg');


    const lightboxCaption =
        document.getElementById('lightboxCaption');


    const lightboxClose =
        document.getElementById('lightboxClose');


    const galleryItems =
        document.querySelectorAll('[data-lightbox]');


    galleryItems.forEach(function (item) {

        item.addEventListener('click', function () {

            const src =
                item.dataset.src;


            const caption =
                item.dataset.caption;


            lightboxImg.src = src;


            lightboxImg.alt = caption;


            lightboxCaption.textContent =
                caption;


            lightbox.classList.add('active');


            document.body.classList.add(
                'lightbox-open'
            );

        });

    });


    function closeLightbox() {

        lightbox.classList.remove(
            'active'
        );


        document.body.classList.remove(
            'lightbox-open'
        );

    }


    lightboxClose.addEventListener(
        'click',
        closeLightbox
    );


    lightbox.addEventListener(
        'click',
        function (event) {

            if (event.target === lightbox) {

                closeLightbox();

            }

        }
    );


    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                closeLightbox();

            }

        }
    );

});
@include('layouts.Footer')
</script>