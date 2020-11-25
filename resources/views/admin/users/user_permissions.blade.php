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
                    @include('admin.users.permissions.module_dashboard')
                    @include('admin.users.permissions.module_products')
                    @include('admin.users.permissions.module_categories')
                </div>
                <div class="row mt-3">
                    @include('admin.users.permissions.module_users')
                </div>
                <div class="row mt-3">
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
