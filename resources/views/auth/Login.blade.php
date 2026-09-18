<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login Admin</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/login.css') }}"
    >

</head>


<body>


<section class="login-section">


    <div class="login-card">


        {{-- =====================================================
             JUDUL
        ====================================================== --}}

        <div class="login-title">

            <span class="section-label">
                ADMINISTRATOR
            </span>

            <h2>
                Login Admin
            </h2>

            <p>
                Silakan masuk untuk mengakses
                halaman administrasi sekolah.
            </p>

        </div>



        {{-- =====================================================
             PESAN ERROR
        ====================================================== --}}

        @if ($errors->any())

            <div class="login-error">

                @foreach ($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif



        {{-- =====================================================
             FORM LOGIN
        ====================================================== --}}

        <form
            action="{{ route('admin.login.process') }}"
            method="POST"
        >

            @csrf


            {{-- =================================================
                 USERNAME
            ================================================== --}}

            <div class="login-group">

                <label for="username">
                    Username
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    autocomplete="username"
                    required
                    autofocus
                >

            </div>



            {{-- =================================================
                 PASSWORD
            ================================================== --}}

            <div class="login-group">

                <label for="password">
                    Password
                </label>


                <div class="password-wrapper">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >


                    {{-- TOGGLE PASSWORD --}}

                    <button
                        type="button"
                        class="password-toggle"
                        id="togglePassword"
                        aria-label="Tampilkan password"
                        aria-pressed="false"
                    >


                        {{-- MATA TERBUKA --}}

                        <svg
                            id="eyeOpen"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path
                                d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"
                            />

                            <circle
                                cx="12"
                                cy="12"
                                r="3"
                            />

                        </svg>



                        {{-- MATA TERTUTUP --}}

                        <svg
                            id="eyeClosed"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            style="display: none;"
                        >

                            <path d="M3 3l18 18" />

                            <path
                                d="M10.6 10.6a2 2 0 0 0 2.8 2.8"
                            />

                            <path
                                d="M9.9 4.2A10.8 10.8 0 0 1 12 4c6.5 0 10 8 10 8a18.2 18.2 0 0 1-3.1 4.4"
                            />

                            <path
                                d="M6.1 6.1C3.4 8.1 2 12 2 12s3.5 8 10 8c1.4 0 2.7-.3 3.9-.8"
                            />

                        </svg>

                    </button>

                </div>

            </div>



            {{-- =================================================
                 TOMBOL LOGIN
            ================================================== --}}

            <button
                type="submit"
                class="login-button"
            >
                Login
            </button>


        </form>



        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        <div class="login-footer">

            <a
                href="{{ route('home') }}"
                class="btn-home"
            >
                ← Kembali ke Home
            </a>

        </div>


    </div>

</section>



{{-- =========================================================
     JAVASCRIPT TOGGLE PASSWORD
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const togglePassword =
        document.getElementById('togglePassword');

    const password =
        document.getElementById('password');

    const eyeOpen =
        document.getElementById('eyeOpen');

    const eyeClosed =
        document.getElementById('eyeClosed');


    // Pastikan semua elemen tersedia
    if (
        !togglePassword ||
        !password ||
        !eyeOpen ||
        !eyeClosed
    ) {
        return;
    }


    togglePassword.addEventListener('click', function () {

        const showPassword =
            password.type === 'password';


        // Ubah tipe input
        password.type =
            showPassword ? 'text' : 'password';


        // Ganti icon
        eyeOpen.style.display =
            showPassword ? 'none' : 'block';

        eyeClosed.style.display =
            showPassword ? 'block' : 'none';


        // Accessibility
        togglePassword.setAttribute(
            'aria-label',
            showPassword
                ? 'Sembunyikan password'
                : 'Tampilkan password'
        );


        togglePassword.setAttribute(
            'aria-pressed',
            showPassword ? 'true' : 'false'
        );

    });

});

</script>


</body>

</html>