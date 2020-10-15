

@extends('connect.master')

@section('title', 'Registrarse')

@section('content')
    <div class="box container" style="margin-top: 3%">
        <div class="header">
            <a href="{{ url('/')  }}">
                <img src="{{ url('/static/images/logo.png')  }}" alt="">
            </a>
        </div>
        <div class="inside">
            {!! Form::open(['url' => '/register']) !!}
            <label for="name">Nombre:</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}</div>
            <label for="lastname">Apellidos:</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user-tag"></i></div>
                </div>
                {!! Form::text('lastname', null, ['class' => 'form-control', 'required']) !!}
            </div>
            <label for="email">Email:</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
                </div>
                {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
            </div>
            <label for="password">Password:</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-lock-open"></i></div>
                </div>
                {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
            </div>
            <label for="cpassword">Confirmar Password:</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </div>
                {!! Form::password('cpassword', ['class' => 'form-control', 'required']) !!}
            </div>
            {!! Form::submit('Registrarse', ['class' => 'btn btn-primary mt-2 w-100']) !!}
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
                <a style="margin-left: 0px" href="{{url('/login')}}">¿Ya tienes una cuenta?</a>
            </div>
        </div>
    </div>
@stop

