@extends('emails.master')
@section('content')
    <p>Hola: <strong>{{ $name }}</strong> <strong>{{ $lastname }}</strong> :)</p>
    <p>Este es un correo electrónico que le ayudará a restablecer la contraseña de su cuenta en nuestra plataforma.</p>
    <p>Para continuar haga click en el siguiente botón e ingrese el siguiente código: <strong> {{ $code }}</strong></p>
    <p><a href="{{ url('/reset') }}" class="btn btn-dark">Recuperar Contraseña</a></p>
    <p>Si el botón anterior no le funciona, copie y pegue la siguiente URL en su navegador:</p>
    <p>{{ url('/reset?email='.$email) }}</p>
@stop

