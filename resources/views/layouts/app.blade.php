<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $title ?? 'SMK NEGERI 1 CIJATI' }}
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/app.css') }}"
    >

</head>

<body>

    @include('layouts.Header')

    <main>

        @yield('content')

    </main>

    @include('layouts.Footer')

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>