@extends('admin.master')

@section('title', 'Productos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i> Productos</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-boxes"></i> Productos</h2>
            </div>
            <div class="inside">
                <div class="container">
                    <a href="{{ url('/admin/product/add') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Añadir Producto</a>
                    <table class="table table-striped mt-2">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Precio</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $p)
                            <tr>
                                <th scope="row">{{ $p->id }}</th>
                                <td><a href="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}" data-fancybox="gallery"><img src="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}" style="width: 40%;" ></a></td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->cat->name }}</td>
                                <td>${{ $p->price }}</td>
                                <td>
                                    <a href="{{ url('/admin/product/'.$p->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="{{ url('/admin/product/'.$p->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
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
