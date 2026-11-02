{{-- Layout mandiri untuk halaman error 500/503. Sengaja tidak memakai
     layouts.app supaya tetap tampil walaupun bagian lain aplikasi bermasalah. --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>@yield('title') - Rencang</title>
    <link rel="icon" type="image/png" href="{{ asset('images/public/logo-rencang.png') }}">
    <link rel="stylesheet" href="{{ asset('css/errors/errors.css') }}">
</head>
<body class="error-body">
    <main class="error-page">
        @yield('body')
    </main>
</body>
</html>
