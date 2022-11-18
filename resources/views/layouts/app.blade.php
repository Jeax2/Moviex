<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        span,
        p,
        a,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: white;
        }

        .logo {
            background: linear-gradient(#fe3149, #fb011e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        body,
        main,
        .backgroud1 {
            background-color: rgb(34, 33, 33)
        }

        body {
            height: 100%;
            background-color: rgb(34, 33, 33);
        }

        .grey-color {
            background-color: rgb(61, 62, 60) !important;
        }

        /* Change the backgroud color of autofill input */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px rgb(41, 39, 39) inset !important;
            -webkit-text-fill-color: white !important;
        }

        .black-input, .black-input:focus {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #white;
            background-color: rgb(34, 33, 33);
            background-clip: padding-box;
            border: 1px solid #ced4da;
            appearance: none;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        input::placeholder {
            font-style: italic
        }

        .black-check {
            background-color: rgb(34, 33, 33);
            background-clip: padding-box;
            border: 1px solid #ced4da;
        }

        .footer-li {
            font-size: 0.5em;
            margin-left: -20px;
            list-style-type: none;
        }

        .footer-li a {
            text-decoration: none
        }

        .footer-li a:hover {
            color: #fb011e;
        }
    </style>


</head>

<body class="dark">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm grey-color">
            <div class="container">
                <a class="navbar-brand" href="{{ url('./') }}">
                    <h1 class="logo">{{ config('app.name', 'Laravel') }}</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><span>{{ __('Register') }}</span></a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white "href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark grey-color">
                                    @if (Auth::user()->role_id == 1)
                                        <li><a class="dropdown-item text-white" href="/admin">Admin area</a></li>
                                    @endif
                                    <li><a class="dropdown-item text-white" href="./">Home</a></li>
                                    <li><a class="dropdown-item text-white" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <footer>
            <hr style="color: white; margin: 1em">
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="col align-self-center">
                            <span class="text-white">Lorem ipsum dolor</span>
                            <ul>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                            </ul>
                        </div>
                        <div class="col align-self-center">
                            <span class="text-white">Lorem ipsum dolor</span>
                            <ul>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                            </ul>
                        </div>
                        <div class="col align-self-center">
                            <span class="text-white">Lorem ipsum dolor</span>
                            <ul>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                                <li class="text-white footer-li"><a href="#">Lorem ipsum dolor</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
