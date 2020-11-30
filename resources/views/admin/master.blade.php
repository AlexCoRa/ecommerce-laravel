<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ \Illuminate\Support\Facades\Route::currentRouteName() }}">

    <link rel="stylesheet" href="{{  url('/css/bootstrap.min.css')  }}">
    <link rel="stylesheet" href="{{ url('/static/css/admin.css?v='.time()) }}">

    <!--fancybox-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/75b758ac89.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="{{  url('/js/bootstrap.min.js')  }}"></script>

    <!--fancybox-->
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <!--ckeditor-->
    <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>

    <!--sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{ url('/static/js/admin.js?v='.time()) }}"></script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>

    <title>Gentleman - @yield('title')</title>
</head>
<body>
<div class="wrapper">
    <div class="col1">@include('admin.sidebar')</div>
    <div class="col2">
        <nav class="navbar navbar-expand-lg shadow">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ '/admin' }}" class="nav-link"><i class="fas fa-home"></i> Dashboard</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="page">

            <div class="container-fluid">
                <nav aria-label="breadcrumb shadow">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/admin') }}"><i class="fas fa-home"></i> Dashboard</a>
                        </li>
                        @section('breadcrumb')
                        @show
                    </ol>
                </nav>
            </div>
        </div>
        @if(\Illuminate\Support\Facades\Session::has('message'))
            <div class="container-fluid">
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
        @section('content')
        @show
    </div>
</div>
</body>
</html>
