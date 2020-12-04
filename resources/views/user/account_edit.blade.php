@extends('master')

@section('title', 'Mi Perfil')

@section('content')
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-user"></i> Editar Avatar</h2>
                </div>
                <div class="inside">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A adipisci, amet at beatae, deleniti dolore dolores eaque eius eos, error est facere facilis fugit illum ipsa iste itaque laborum necessitatibus neque nulla pariatur perspiciatis quasi quibusdam quisquam reprehenderit sit voluptas?
                </div>
            </div>
            <div class="panel shadow mt-3">
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
                            <label for="npassword">Nueva Contraseña:</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                {!! Form::password('npassword' ,['class' => 'form-control']) !!}
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
                            {!! Form::submit('Guardar' ,['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-8">
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
                                {!! Form::number('year', null, ['class' => 'form-control', 'min' => getUserYears()[1], 'max' => getUserYears()[0] , 'required']) !!}
                                {!! Form::select('user_type', getMonths('list', null), null, ['class' => 'form-select']) !!}
                                {!! Form::number('year', null, ['class' => 'form-control', 'min' => 1, 'max' => 31, 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="module">Genero: </label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                                {!! Form::select('gener', ['0' => 'Sin especificar', '1' => 'Hombre', '2' => 'Mujer'], null, ['class' => 'form-select']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

