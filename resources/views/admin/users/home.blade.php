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
                    <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
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
                            <td>
                                <a href="{{ url('/admin/user/'.$user->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="{{ url('/admin/user/'.$user->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection
