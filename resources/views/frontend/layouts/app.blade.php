<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title")</title>

    {{-- Fontawesome --}}
    <script src="https://kit.fontawesome.com/2c87f61656.js" crossorigin="anonymous" defer></script>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div>

        <header>
            <div class="row justify-content-center bg-light py-2 pt-3">
                <div class="col-lg-8">
                    <div class="row text-center align-items-center">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4 h4">
                            @yield("title")
                        </div>
                        <div class="col-lg-4">
                            <a href="#" class="text-decoration-none btn-theme">
                                <i class="fa-solid fa-bell"></i><br>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <div class="container content">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer>
            <div class="row justify-content-center bg-light py-2 pt-3">
                <div class="col-lg-8">
                    <div class="row text-center">
                        <div class="col-lg-4">
                            <a href="{{route('home')}}" class="text-decoration-none text-dark">
                                <i class="fa-solid fa-home"></i><br>
                                <span>HOME</span>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="fa-solid fa-qrcode"></i><br>
                                <span>SCAN</span>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{route('profile')}}" class="text-decoration-none text-dark">
                                <i class="fa-solid fa-user"></i><br>
                                <span>ACCOUNT</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    @yield("scripts")
</body>

</html>