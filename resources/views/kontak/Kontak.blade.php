@extends('layouts.app')

@section('content')

{{-- CSS Halaman Kontak --}}
<link rel="stylesheet" href="{{ asset('css/kontak.css') }}">

<div class="contact-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}
    <div class="contact-header">

        <div class="container">

            <h1>Hubungi Kami</h1>

            <p>
                Silakan hubungi kami jika Anda memiliki pertanyaan.
                Kami siap membantu Anda.
            </p>

        </div>

    </div>


    {{-- =====================================================
         CONTENT
    ====================================================== --}}
    <section class="contact-section container">

        <div class="contact-layout">

            {{-- =================================================
                 INFORMASI KONTAK
            ================================================== --}}
            <div class="contact-info">

                <h2>Informasi Kontak</h2>

                <p>
                    Silakan hubungi kami melalui informasi
                    kontak berikut.
                </p>


                {{-- Alamat --}}
                <div class="contact-item">

                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>

                    <div class="contact-item-content">

                        <h3>Alamat</h3>

                        <p>
                            {{ $profil->alamat ?? '-' }}
                        </p>

                    </div>

                </div>


                {{-- Telephone --}}
                <div class="contact-item">

                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>

                    <div class="contact-item-content">

                        <h3>Telephone</h3>

                        <p>
                            {{ $profil->telephone ?? '-' }}
                        </p>

                    </div>

                </div>


                {{-- Email --}}
                <div class="contact-item">

                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>

                    <div class="contact-item-content">

                        <h3>Email</h3>

                        <p>
                            {{ $profil->email ?? '-' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 FORM KONTAK
            ================================================== --}}
            <div class="contact-form-card">

                <h2>Kirim Pesan</h2>


                {{-- Pesan berhasil --}}
                @if(session('success'))

                    <div class="contact-alert-success">

                        {{ session('success') }}

                    </div>

                @endif


                {{-- Pesan error --}}
                @if($errors->any())

                    <div class="contact-alert-error">

                        <ul>

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    action="{{ route('kontak.store') }}"
                    method="POST"
                >

                    @csrf


                    {{-- Nama --}}
                    <div class="contact-form-group">

                        <label for="nama">
                            Nama
                        </label>

                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            value="{{ old('nama') }}"
                            placeholder="Masukkan nama"
                            required
                        >

                    </div>


                    {{-- Email --}}
                    <div class="contact-form-group">

                        <label for="email">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email"
                            required
                        >

                    </div>


                    {{-- Pesan --}}
                    <div class="contact-form-group">

                        <label for="pesan">
                            Pesan
                        </label>

                        <textarea
                            id="pesan"
                            name="pesan"
                            placeholder="Tulis pesan Anda..."
                            required
                        >{{ old('pesan') }}</textarea>

                    </div>


                    {{-- Tombol --}}
                    <button
                        type="submit"
                        class="contact-submit"
                    >
                        Kirim Pesan
                    </button>

                </form>

            </div>

        </div>

    </section>

</div>

@endsection