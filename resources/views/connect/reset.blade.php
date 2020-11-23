@extends('connect.master')

@section('title', 'Recuperar Contraseña')

@section('content')
<div class="box container" style="margin-top: 8%">
    <div class="header">
        <a href="{{ url('/')  }}">
            <img src="{{ url('/static/images/logo.png')  }}" alt="">
        </a>
    </div>
    <div class="inside">
        {!! Form::open(['url' => '/reset']) !!}
        <label for="email">Email:</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
            </div>
            {!! Form::email('email', $email, ['class' => 'form-control'], 'required') !!}
        </div>

        <label class="mt-3" for="code">Código de recuperación:</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
            </div>
            {!! Form::number('code', null, ['class' => 'form-control'], 'required') !!}
        </div>

        {!! Form::submit('Enviar código', ['class' => 'btn btn-primary mt-3 w-100']) !!}
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
            <a href="{{url('/register')}}">¿No tienes una cuenta?</a>
            <a href="{{url('/login')}}">Ingresar a mi cuenta</a>
        </div>
    </div>
</div>
@stop

