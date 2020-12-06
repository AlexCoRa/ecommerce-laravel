@extends('master')

@section('title', 'Mi Perfil')

@section('content')
    <div class="row mt-4">
        <div class="col-md-4">
            <!--Editar avatar-->
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-user"></i> Editar Avatar</h2>
                </div>
                <div class="inside">
                    <div class="edit_avatar">
                        {!! Form::open(['url' => '/account/edit/avatar', 'id' => 'form_avatar_change' ,'files' => true]) !!}
                            <a href="#" id="btn_avatar_edit">
                                <span class="overlay" id="avatar_change_overlay"><i class="fas fa-camera"></i></span>
                                @if(is_null(\Illuminate\Support\Facades\Auth::user()->avatar))
                                    <img src="{{ url('/static/images/default_profile.jpg') }}">
                                @else
                                    <img src="{{ url('/uploads_users/'.\Illuminate\Support\Facades\Auth::id().'/av_'.\Illuminate\Support\Facades\Auth::user()->avatar) }}" alt="">
                                @endif
                            </a>
                        {!! Form::file('avatar', ['id' => 'input_file_avatar', 'accept' => 'image/*' ,'class' => 'form-control']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!--Editar contraseña-->
            <div class="panel shadow mt-3 mb-3">
                <div class="header">
                    <h2 class="title"><i class="fas fa-unlock-alt"></i> Cambiar Contraseña</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/account/edit/password']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="apassword">Contraseña Actual:</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                {!! Form::password('apassword' ,['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="password">Nueva Contraseña:</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                {!! Form::password('password' ,['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="cpassword">Confirmar Nueva Contraseña:</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                {!! Form::password('cpassword' ,['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            {!! Form::submit('Guardar' ,['class' => 'btn btn-secondary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!--Editar informacion-->
        <div class="col-md-8 mb-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-address-card"></i> Editar Informacíon</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/account/edit/info']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    {!! Form::text('name', \Illuminate\Support\Facades\Auth::user()->name,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="lastname">Apellidos:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    {!! Form::text('lastname', \Illuminate\Support\Facades\Auth::user()->lastname,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="email">Correo Electrónico:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    {!! Form::text('email', \Illuminate\Support\Facades\Auth::user()->email,['class' => 'form-control', 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="phone">Teléfono</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                {!! Form::number('phone', \Illuminate\Support\Facades\Auth::user()->phone,['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="module">Fecha de Nacimiento: Año - Mes - Dia</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                                {!! Form::number('year', $birthday[0], ['class' => 'form-control', 'min' => getUserYears()[1], 'max' => getUserYears()[0] , 'required']) !!}
                                {!! Form::select('month', getMonths('list', null), $birthday[1], ['class' => 'form-select']) !!}
                                {!! Form::number('day', $birthday[2], ['class' => 'form-control', 'min' => 01, 'max' => 31, 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="module">Genero: </label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                                {!! Form::select('gender', ['0' => 'Sin especificar', '1' => 'Hombre', '2' => 'Mujer'], \Illuminate\Support\Facades\Auth::user()->gender, ['class' => 'form-select']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-secondary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

