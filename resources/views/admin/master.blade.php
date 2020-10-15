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

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/75b758ac89.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="{{  url('/js/bootstrap.min.js')  }}"></script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>

    <title>@yield('title')</title>
</head>
<body>
<div class="wrapper">
    <div class="row">
        <div class="col-2">@include('admin.sidebar')</div>
        <div class="col-10"></div>
    </div>
</div>
</body>
</html>
