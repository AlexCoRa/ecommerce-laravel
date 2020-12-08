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
        <div class="row">
            <div class="col-md-12">
                <label for="email">Email:</label>
                <div class="input-group mb-2">
                    <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
                    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="password" class="mt-2">Password:</label>
                <div class="input-group mb-2">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                </div>
                {!! Form::submit('Ingresar', ['class' => 'btn btn-primary mt-3 w-100']) !!}
            </div>
        </div>


        @if(\Illuminate\Support\Facades\Session::has('message'))
            <div class="container">
                <div class="mt-2 alert alert-{{ \Illuminate\Support\Facades\Session::get('typealert') }}" style="display: none;">
                    {{ \Illuminate\Support\Facades\Session::get('message') }}
                    @if ($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif
                    <script>
                        $('.alert').slideDown();
                        setTimeout(function () {
                            $('.alert').slideUp();
                        }, 5000);
                    </script>
                </div>
            </div>
        @endif
        {!! Form::close() !!}
        <div class="footer mt-4 mb-2">
            <div class="row">
                <div class="col-md-12">
                    <a class="mb-2" href="{{url('/register')}}">¿No tienes una cuenta?</a>
                </div>
                <div class="col-md-12">
                    <a href="{{url('/recover')}}">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

