@extends('admin.master')

@section('title', 'Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/users') }}"><i class="fas fa-users"></i> Usuarios</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-users"></i> Usuarios</h2>
            </div>
            <div class="inside">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 offset-md-10">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-filter"></i> Filtrar
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ url('/admin/users/all') }}"><i class="fas fa-user-friends"></i> Todos</a>
                                    <a class="dropdown-item" href="{{ url('/admin/users/0') }}"><i class="fas fa-user-clock"></i> No Verificados</a>
                                    <a class="dropdown-item" href="{{ url('/admin/users/1') }}"><i class="fas fa-user-check"></i> Verificados</a>
                                    <a class="dropdown-item" href="{{ url('/admin/users/100') }}"><i class="fas fa-users-slash"></i> Suspendidos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped mt-2">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Estado</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ getUserRoleArray(null, $user->role) }}</td>
                            <td>{{ getUserStatusArray(null, $user->status) }}</td>
                            <td>
                                <a href="{{ url('/admin/user/'.$user->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Ver Usuario"><i class="fas fa-edit"></i></a>
                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="7">{!! $users->render() !!}</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection
