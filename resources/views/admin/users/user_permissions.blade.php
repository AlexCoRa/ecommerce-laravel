@extends('admin.master')

@section('title', 'Permisos de Usuario')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/users/all') }}"><i class="fas fa-users"></i> Usuarios</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fas fa-cogs"></i> Permisos del Usuario: {{ $u->name }} {{ $u->lastname }}</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">
            <form action="{{ url('/admin/user/'.$u->id.'/permissions') }}" method="POST">
                @csrf

                <div class="row">
                    <!--Sistema de permisos semi automatizados en Functions-->
                    @foreach(userPermissions() as $key => $value)
                        <div class="col-md-4 d-flex mb-4">
                            <div class="panel shadow">
                                <div class="header">
                                    <h2 class="title">{!! $value['icon'] !!} {!! $value['title'] !!}</h2>
                                </div>
                                <div class="inside">
                                    @foreach($value['keys'] as $k => $v)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="true" name="{{ $k }}" @if(kvfj($u->permissions, $k)) checked @endif >
                                            <label class="form-check-label" for="dashboard">{{ $v }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel shadow">
                            <div class="inside">
                                <input type="submit" value="Guardar" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
