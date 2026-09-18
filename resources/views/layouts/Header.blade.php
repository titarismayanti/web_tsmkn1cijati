<header class="site-header">

    {{-- =========================================================
         TOPBAR
    ========================================================== --}}
    <div class="topbar">

        <div class="container topbar-inner">

            <span>
                SMK NEGERI 1 CIJATI
            </span>

            <span>
                Jawa Barat
            </span>

        </div>

    </div>


    {{-- =========================================================
         NAVBAR
    ========================================================== --}}
    <nav class="navbar container">

        {{-- LOGO / BRAND --}}
        <a
            href="{{ route('home') }}"
            class="brand"
        >

            <span class="brand-logo">
    <img
        src="{{ asset('image/logo-sekolah.jpeg') }}"
        alt="Logo SMK Negeri 1 Cijati"
    >
</span>

            <span>
                SMK NEGERI 1 CIJATI
            </span>

        </a>


        {{-- MOBILE TOGGLE --}}
        <button
            type="button"
            class="nav-toggle"
            id="navToggle"
            aria-label="Buka menu"
            aria-controls="navMenu"
            aria-expanded="false"
        >

            <span></span>
            <span></span>
            <span></span>

        </button>


        {{-- =====================================================
             MENU
        ====================================================== --}}
        <ul
            class="nav-menu"
            id="navMenu"
        >

            {{-- BERANDA --}}
            <li>

                <a href="{{ route('home') }}">
                    Beranda
                </a>

            </li>


            {{-- =================================================
                 PROFIL
            ================================================== --}}
            <li class="has-dropdown">

                <a href="{{ route('profil') }}">
                    Profil
                    <span aria-hidden="true">▾</span>
                </a>


                <ul class="dropdown">

                    {{-- Identitas Sekolah --}}
                    <li>

                        <a href="{{ route('profil') }}">
                            Identitas Sekolah
                        </a>

                    </li>


                    {{-- Guru --}}
                    <li>

                        <a href="{{ route('profil.guru') }}">
                            Data Guru
                        </a>

                    </li>


                    {{-- Fasilitas --}}
                    <li>

                        <a href="{{ route('profil.fasilitas') }}">
                            Fasilitas
                        </a>

                    </li>

                </ul>

            </li>


            {{-- =================================================
                 KONSENTRASI KEAHLIAN
                 Tidak ada route khusus di web.php,
                 sehingga diarahkan ke section Home.
            ================================================== --}}
            <li>

                <a href="{{ route('home') }}#konsentrasi-keahlian">
                    Konsentrasi Keahlian
                </a>

            </li>


            {{-- =================================================
                 EKSTRAKURIKULER
            ================================================== --}}
            <li>

                 <a href="{{ route('home') }}#ekstrakurikuler">
                    ekstrakurikuler
                </a>

            </li>

            {{-- =================================================
     ARTIKEL / BERITA & KEGIATAN
================================================== --}}
<li>

    <a href="{{ route('home') }}#artikel">
        Berita & Kegiatan
    </a>

</li>

            {{-- =================================================
                 GALERI
            ================================================== --}}
            <li>

                <a href="{{ route('home') }}#galeri">
                    Galeri
                </a>

                {{-- =================================================
                KONTAK
            ================================================== --}}
            <li>

                <a href="{{ route('kontak') }}">
                    Kontak
                </a>

            </li>

        </ul>

    </nav>

</header>