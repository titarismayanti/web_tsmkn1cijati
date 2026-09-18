@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profil.css') }}">


<section class="page-header">
    <div class="container">

        <h1>Profil Sekolah</h1>

        <p>
            Mengenal lebih dekat
            {{ $profil->nama_sekolah ?? config('app.name', 'SMK NEGERI 1 CIJATI') }}
        </p>

    </div>
</section>


<section class="section container">

    </div>


    @if ($profil)

        <!-- PROFILE LAYOUT -->
        <div class="profile-layout">


            <!-- INFORMASI SEKOLAH -->
            <div class="profile-table-wrap">

                <h2>Informasi Umum</h2>

                <div class="school-info">

                    <!-- DATA SEKOLAH -->
                    <div class="school-data">

                        <div class="info-item">

                            <span class="info-label">
                                Nama Sekolah
                            </span>

                            <span class="info-value">
                                {{ $profil->nama_sekolah }}
                            </span>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Akreditasi
                            </span>

                            <span class="info-value">
                                {{ $profil->akreditasi }}
                            </span>

                        </div>


                        <div class="info-item sejarah-item">

                            <span class="info-label">
                                Sejarah
                            </span>

                            <span class="info-value">
                                {{ $profil->sejarah }}
                            </span>

                        </div>

                    </div>


                    <!-- LOGO SEKOLAH -->
                    <div class="school-logo">

                        <div class="logo-circle">

                            <img
                                src="{{ asset('image/logo-sekolah.jpeg') }}"
                                alt="Logo {{ $profil->nama_sekolah }}"
                            >

                        </div>

                        <h3>
                            {{ $profil->nama_sekolah }}
                        </h3>

                        <span>
                            Profil Sekolah
                        </span>

                    </div>

                </div>

            </div>


            <!-- VISI DAN MISI -->
            <div class="profile-side">

                <div class="visi-misi-card">

                    <h3>Visi</h3>

                    <p>
                        {{ $profil->visi }}
                    </p>


                    <h3>Misi</h3>

                    <p>
                        {!! nl2br(e($profil->misi)) !!}
                    </p>

                </div>

            </div>


        </div>

    @else

        <!-- DATA KOSONG -->
        <div class="empty-state">

            <p>
                Belum ada data profil sekolah.
            </p>

        </div>

    @endif

</section>
@endsection