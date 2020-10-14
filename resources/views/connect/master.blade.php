<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gentleman - @yield('title')</title>
    <link rel="stylesheet" href="{{  url('/css/bootstrap.min.css')  }}">
    <link rel="stylesheet" href="{{ url('/static/css/connect.css?=v'.time()) }}">
    <script src="https://kit.fontawesome.com/75b758ac89.js" crossorigin="anonymous"></script>
</head>
<body>
        @section('content')

        @show
</body>
</html>
