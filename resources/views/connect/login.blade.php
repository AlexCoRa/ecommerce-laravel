@extends('connect.master')

@section('title', 'Login')

@section('content')
<div class="box container" style="margin-top: 8%">
    <div class="header">
        <a href="{{ url('/')  }}">
            <img src="{{ url('/static/images/logo.png')  }}" alt="">
        </a>
    </div>
    <div class="inside">
        {!! Form::open(['url' => '/login']) !!}
        <label for="email">Email:</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
            </div>
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>
        <label for="password" class="mt-2">Password:</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Ingresar', ['class' => 'btn btn-primary mt-3 w-100']) !!}
        {!! Form::close() !!}
        <div class="footer mt-4 mb-2">
            <a href="{{url('/register')}}">¿No tienes una cuenta?</a>
            <a href="{{url('/recover')}}">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</div>
@stop

