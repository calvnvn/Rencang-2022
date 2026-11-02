<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page Title -->
    <title>{{ $title ?? config('rencang.name') }}</title>
    <!-- Rencang Icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/public/logo-rencang.png') }}">
    <!-- CSS -->
    <!-- Bootstrap 4.5 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Custom CSS Navigation Bar -->
    <link rel="stylesheet" href="{{ asset('css/navbar/navbar.css') }}">
    <!-- Custom CSS Footer -->
    <link rel="stylesheet" href="{{ asset('css/footer/footer.css') }}">

    <!-- Custom CSS -->
    @yield('custom-css')
</head>

<body>
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')

    <!-- Javascript -->
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap & Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/sweetalert/sweetalert.js') }}"></script>

    <!-- Custom JS Navigation Bar -->
    <script>
        $(document).ready(function(){
            $('#dropdownToggle').hover(function(){
                $('#dropdownMenu').show();
            }, function(){
                $('#dropdownMenu').hide();
            });

            $('#dropdownToggle').click(function(){
                $('#dropdownMenu').show();
            });

            $('#dropdownMenu').hover(function(){
                $('#dropdownMenu').show();
            }, function(){
                $('#dropdownMenu').hide();
            });

            $('.dropdown-item').hover(function(){
                $(this).css('color', '#FFF3E1');
            }, function(){
                $(this).css('color', '#388177');
            });

            // Tandai menu aktif berdasarkan segmen terakhir URL; "/" berarti Home.
            var url = window.location.pathname;
            var filename = url.substring(url.lastIndexOf('/')+1).split('.');
            var menuId = filename[0] || 'home';
            $('.navbar #' + menuId).addClass("active");
        });
    </script>
    @yield('custom-js')
</body>
</html>