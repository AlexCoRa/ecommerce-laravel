<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, shrink-to-fit=no ,user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="routeName" content="{{ \Illuminate\Support\Facades\Route::currentRouteName() }}">

        <link rel="stylesheet" href="{{  url('/css/bootstrap.min.css')  }}">
        <link rel="stylesheet" href="{{ url('/static/css/style.css?v='.time()) }}">
        <!--fancybox-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/75b758ac89.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="{{  url('/js/bootstrap.min.js')  }}"></script>
        <!--fancybox-->
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        <!--ckeditor
        <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script> -->
        <!--sweetalert-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ url('/static/js/site.js?v='.time()) }}"></script>

        <title>@yield('title') - Gentleman</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light shadow">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('static/images/logo_home.png') }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigationMain" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse link" id="navigationMain">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-home"></i> <span>Inicio</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-store-alt"></i> <span>Tienda</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-user-friends"></i> <span>Nosotros</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-paper-plane"></i> <span>Contáctanos</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-shopping-cart"></i> <span class="car-number">(0)</span></a>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::guest())
                            <li class="nav-item">
                                <a href="{{ url('/login') }}" class="nav-link btn"><i class="fas fa-fingerprint"></i> Ingresar</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/register') }}" class="nav-link btn"><i class="fas fa-user-circle"></i> Registrarse</a>
                            </li>
                        @else
                            <li class="nav-item link-user dropdown">
                                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                    @if(is_null(\Illuminate\Support\Facades\Auth::user()->avatar))
                                        <img src="{{ url('/static/images/default_profile.jpg') }}">
                                    @else
                                        <img src="{{ url('/uploads_users/'.\Illuminate\Support\Facades\Auth::id().'/av_'.\Illuminate\Support\Facades\Auth::user()->avatar) }}" alt="">
                                    @endif
                                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                    {{ \Illuminate\Support\Facades\Auth::user()->lastname }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @if(\Illuminate\Support\Facades\Auth::user()->role == '1')
                                        <li><a class="dropdown-item" href="{{ url('/admin') }}"><i class="fas fa-chalkboard-teacher"></i> Administración</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ url('/account/edit') }}"><i class="fas fa-address-card"></i> Mi perfil</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt"></i> Salir</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @if(\Illuminate\Support\Facades\Session::has('message'))
            <div class="container">
                <div class="alert alert-{{\Illuminate\Support\Facades\Session::get('typealert')}} mt-2" style="display: block; margin-bottom: 16px;">
                    {{ \Illuminate\Support\Facades\Session::get('message') }}
                    @if($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <script>
                        $('.alert').slideDown();
                        setTimeout(function () {
                            $('.alert').slideUp();
                        }, 10000);
                    </script>
                </div>
            </div>
        @endif
        <div class="wrapper">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </body>
</html>
