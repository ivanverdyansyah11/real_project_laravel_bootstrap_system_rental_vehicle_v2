<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | {{ $page }} Nova Ride App</title>

    {{-- STYLE CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <script src="https://kit.fontawesome.com/e5ccf98c71.js" crossorigin="anonymous"></script>
    {{-- END STYLE CSS --}}
</head>

<body class="{{ Route::is('login') ? 'login' : 'mb-5' }}" id="home">
    @if (Route::is('login.index'))
        <main class="login">
            @yield('content-auth')
        </main>
    @else
        @include('components.sidebar')
        <main class="dashboard w-100">
            <div class="row">
                <div class="col-12">
                    @include('components.topbar')
                    @yield('content-dashboard')
                </div>
            </div>
        </main>
    @endif

    {{-- SCRIPT JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    @stack('child-script')
    {{-- END SCRIPT JS --}}
</body>

</html>
