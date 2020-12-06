@extends('admin.master')

@section('title', 'Editar Usuario')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/users') }}"><i class="fas fa-users"></i> Usuarios</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-user"></i> Información</h2>
                        </div>
                        <div class="inside">
                            <div class="container">
                                <div class="mini_profile">
                                    @if(is_null($u->avatar))
                                        <img src="{{ url('/static/images/default_profile.jpg') }}" alt="profile" class="avatar">
                                    @else
                                        <img src="{{ url('/uploads_users/'.$u->id.'/'.$u->avatar) }}" alt="profile" class="avatar">
                                    @endif
                                    <div class="info">
                                        <span class="title"><i class="far fa-address-card"></i> Nombre: </span>
                                        <span class="text">{{ $u->name }} {{ $u->lastname }}</span>
                                        <span class="title"><i class="far fa-envelope"></i> Correo Electrónico: </span>
                                        <span class="text">{{ $u->email }}</span>
                                        <span class="title"><i class="fas fa-user-check"></i> Estado del Usuario: </span>
                                        <span class="text">{{ getUserStatusArray(null, $u->status) }}</span>
                                        <span class="title"><i class="far fa-calendar-alt"></i> Fecha de Registro: </span>
                                        <span class="text">{{ $u->created_at }}</span>
                                        <span class="title"><i class="fas fa-user-shield"></i> Role del Usuario: </span>
                                        <span class="text">{{ getUserRoleArray(null, $u->role) }}</span>
                                    </div>
                                        @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'user_banned'))
                                            @if($u->status == "100")
                                                <a href="{{ url('/admin/user/'.$u->id.'/banned') }}" class="btn btn-sm btn-success">Activar Usuario</a>
                                            @else
                                                <a href="{{ url('/admin/user/'.$u->id.'/banned') }}" class="btn btn-sm btn-danger">Suspender Usuario</a>
                                            @endif
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'users_edit'))
                    <div class="col-md-8">
                        <div class="panel shadow">
                            <div class="header">
                                <h2 class="title"><i class="fas fa-user-edit"></i> Editar Información</h2>
                            </div>
                            <div class="inside">
                                <div class="container">
                                    {!! Form::open(['url' => '/admin/user/'.$u->id.'/edit']) !!}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="module">Tipo de Usuario:</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                                                    {!! Form::select('user_type', getUserRoleArray('list', null), $u->role, ['class' => 'form-select']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
