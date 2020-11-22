<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{  url('/css/bootstrap.min.css')  }}">
    <title>Recuperar Contraseña</title>
</head>
<body style="margin: 0px; padding: 0px; background-color: #f3f3f3;">
    <div style="display: block; width: 60%; max-width: 489px; margin: 0px auto;">
        <img src="{{ url('/static/images/email_logo.PNG')  }}" style="width: 100%; display: block;" alt="gentleman_logo">
        <div style="background-color: #fff; padding: 1px 24px;">
            <hr>
            @yield('content')
        </div>
    </div>
</body>
</html>
