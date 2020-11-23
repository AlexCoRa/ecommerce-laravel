@extends('emails.master')
@section('content')
    <p>Hola: <strong>{{ $name }}</strong> <strong>{{ $lastname }}</strong> :)</p>
    <p>Esta es tu nueva contraseña para tu cuenta en nuestra plataforma.</p>
    <p><h2>{{ $password }}</h2></p>
    <p>Para iniciar sesión haga click en el siguiente enlace.</strong></p>
    <p><a href="{{ url('/login') }}" class="btn btn-dark">Iniciar Sesión</a></p>
    <p>Si el botón anterior no le funciona, copie y pegue la siguiente URL en su navegador:</p>
    <p>{{ url('/login') }}</p>
@stop

