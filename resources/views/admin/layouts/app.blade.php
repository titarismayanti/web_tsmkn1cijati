<!DOCTYPE html> <html lang="id"> <head>
<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>
    @yield('title', 'Admin - SMK Negeri 1 Cijati')
</title>

{{-- Bootstrap --}}
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>

{{-- Bootstrap Icons --}}
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>

{{-- CSS ADMIN --}}
<link
    rel="stylesheet"
    href="{{ asset('css/admin/admin-layout.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('css/admin/admin.css') }}"
>

{{-- CSS TAMBAHAN HALAMAN ADMIN --}}
@stack('styles')

</head> <body> <div class="admin-wrapper">
{{-- =====================================================
     SIDEBAR
====================================================== --}}

<aside
    class="admin-sidebar"
    id="adminSidebar"
>

    {{-- SIDEBAR HEADER --}}

    <div class="sidebar-header">

        <div class="sidebar-logo">
            <i class="bi bi-building"></i>
        </div>

        <div class="sidebar-brand">

            <strong>
                SMKN 1 CIJATI
            </strong>

            <span>
                ADMINISTRATOR
            </span>

        </div>

    </div>


    {{-- SIDEBAR MENU --}}

    <nav class="sidebar-menu">

        {{-- UTAMA --}}

        <div class="menu-label">
            UTAMA
        </div>


        {{-- DASHBOARD --}}

        <a
            href="{{ route('admin.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
        >

            <i class="bi bi-grid-1x2-fill"></i>

            <span>
                Dashboard
            </span>

        </a>


        {{-- DATA SEKOLAH --}}

        <div class="menu-label">
            DATA SEKOLAH
        </div>


        {{-- GURU --}}

        <a
            href="{{ route('admin.guru') }}"
            class="sidebar-link {{ request()->routeIs('admin.guru') ? 'active' : '' }}"
        >

            <i class="bi bi-person-workspace"></i>

            <span>
                Data Guru
            </span>

        </a>


        {{-- SISWA --}}

        <a
            href="{{ route('admin.siswa') }}"
            class="sidebar-link {{ request()->routeIs('admin.siswa') ? 'active' : '' }}"
        >

            <i class="bi bi-people-fill"></i>

            <span>
                Data Siswa
            </span>

        </a>


        {{-- JURUSAN --}}

        <a
            href="{{ route('admin.jurusan') }}"
            class="sidebar-link {{ request()->routeIs('admin.jurusan') ? 'active' : '' }}"
        >

            <i class="bi bi-mortarboard-fill"></i>

            <span>
                Jurusan
            </span>

        </a>


        {{-- EKSTRAKURIKULER --}}

        <a
            href="{{ route('admin.ekstrakurikuler') }}"
            class="sidebar-link {{ request()->routeIs('admin.ekstrakurikuler') ? 'active' : '' }}"
        >

            <i class="bi bi-trophy-fill"></i>

            <span>
                Ekstrakurikuler
            </span>

        </a>

        {{-- FASILITAS --}}

<a
    href="{{ route('admin.fasilitas') }}"
    class="sidebar-link {{ request()->routeIs('admin.fasilitas') ? 'active' : '' }}"
>

    <i class="bi bi-buildings-fill"></i>

    <span>
        Fasilitas
    </span>

</a>



        {{-- PROFIL --}}

        <a
            href="{{ route('admin.profil') }}"
            class="sidebar-link {{ request()->routeIs('admin.profil') ? 'active' : '' }}"
        >

            <i class="bi bi-building-fill"></i>

            <span>
                Profil Sekolah
            </span>

        </a>


        {{-- KONTEN --}}

        <div class="menu-label">
            KONTEN
        </div>


        {{-- ARTIKEL --}}

        <a
            href="{{ route('admin.artikel') }}"
            class="sidebar-link {{ request()->routeIs('admin.artikel') ? 'active' : '' }}"
        >

            <i class="bi bi-newspaper"></i>

            <span>
                Artikel
            </span>

        </a>


        {{-- GALERI --}}

        <a
            href="{{ route('admin.galeri') }}"
            class="sidebar-link {{ request()->routeIs('admin.galeri') ? 'active' : '' }}"
        >

            <i class="bi bi-images"></i>

            <span>
                Galeri
            </span>

        </a>


        {{-- KONTAK --}}

        <a
            href="{{ route('admin.kontak') }}"
            class="sidebar-link {{ request()->routeIs('admin.kontak') ? 'active' : '' }}"
        >

            <i class="bi bi-envelope-fill"></i>

            <span>
                Kontak
            </span>

        </a>

    </nav>


    {{-- =================================================
         SIDEBAR FOOTER
    ================================================== --}}

    <div class="sidebar-footer">

        <div class="admin-user">

            <div class="admin-avatar">

                <i class="bi bi-person-fill"></i>

            </div>

            <div class="admin-user-info">

                <strong>
                    {{ Auth::user()->username ?? 'Admin' }}
                </strong>

                <span>
                    Administrator
                </span>

            </div>

        </div>


        {{-- LOGOUT --}}

        <form
            action="{{ route('admin.logout') }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="logout-button"
            >

                <i class="bi bi-box-arrow-right"></i>

                <span>
                    Logout
                </span>

            </button>

        </form>

    </div>

</aside>


{{-- =====================================================
     MOBILE OVERLAY
====================================================== --}}

<div
    class="sidebar-overlay"
    id="sidebarOverlay"
></div>


{{-- =====================================================
     MAIN
====================================================== --}}

<main class="admin-main">


    {{-- TOPBAR --}}

    <header class="admin-topbar">

        <button
            type="button"
            class="sidebar-toggle"
            id="sidebarToggle"
            aria-label="Buka menu"
            aria-expanded="false"
        >

            <i class="bi bi-list"></i>

        </button>


        <div class="topbar-title">

            <span>
                PANEL ADMINISTRATOR
            </span>

            <strong>
                SMK NEGERI 1 CIJATI
            </strong>

        </div>

    </header>


    {{-- =================================================
         CONTENT
    ================================================== --}}

    <div class="admin-content">

        @yield('content')

    </div>


    {{-- =================================================
         FOOTER
    ================================================== --}}

    <footer class="admin-footer">

        © {{ date('Y') }} SMK NEGERI 1 CIJATI

    </footer>

</main>

</div>
{{-- =====================================================
JAVASCRIPT SIDEBAR
====================================================== --}}

<script> document.addEventListener('DOMContentLoaded', function () { const sidebar = document.getElementById('adminSidebar'); const toggle = document.getElementById('sidebarToggle'); const overlay = document.getElementById('sidebarOverlay'); if (!sidebar || !toggle || !overlay) { return; } function openSidebar() { sidebar.classList.add('show'); overlay.classList.add('show'); toggle.setAttribute('aria-expanded', 'true'); document.body.classList.add('sidebar-open'); } function closeSidebar() { sidebar.classList.remove('show'); overlay.classList.remove('show'); toggle.setAttribute('aria-expanded', 'false'); document.body.classList.remove('sidebar-open'); } toggle.addEventListener('click', function () { if (sidebar.classList.contains('show')) { closeSidebar(); } else { openSidebar(); } }); overlay.addEventListener('click', function () { closeSidebar(); }); document.addEventListener('keydown', function (event) { if (event.key === 'Escape') { closeSidebar(); } }); window.addEventListener('resize', function () { if (window.innerWidth > 992) { closeSidebar(); } }); }); </script>
{{-- =====================================================
JAVASCRIPT TAMBAHAN HALAMAN
====================================================== --}}

@stack('scripts')

</body> </html>