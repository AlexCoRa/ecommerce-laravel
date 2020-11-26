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
                <ul>
                    @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'products_add'))
                        <li>
                            <a href="{{ url('/admin/product/add') }}" class=""><i class="fas fa-plus"></i> Añadir Producto</a>
                        </li>
                    @endif
                    <li>
                        <a href="#"><i class="fas fa-chevron-down"></i> Filtrar</a>
                        <ul class="shadow">
                            <li><a href="{{ url('/admin/products/all') }}"><i class="fas fa-list-ul"></i> Todos</a></li>
                            <li><a href="{{ url('/admin/products/1') }}"><i class="fas fa-globe-americas"></i> Públicos</a></li>
                            <li><a href="{{ url('/admin/products/0') }}"><i class="fas fa-eraser"></i> Borradores</a></li>
                            <li><a href="{{ url('/admin/products/trash') }}"><i class="fas fa-trash"></i> Papelera</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class=""><i class="fas fa-search"></i> Buscar</a>
                        <ul>
                            <li>
                                {!! Form::open(['url' => '/admin/products/search']) !!}
                                {!! Form::text('search', null, ['class'=> 'form-control', 'placeholder'=> 'Buscar']) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="inside">
                <div class="container">
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $p)
                            <tr>
                                <th scope="row">{{ $p->id }}</th>
                                <td><a href="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}" data-fancybox="gallery"><img src="{{ url('/uploads/'.$p->file_path.'/t_'.$p->image) }}" style="width: 40%" ></a></td>
                                <td style="margin-left: 200px !important;">{{ $p->name }} @if($p->status == "0") <i class="fas fa-eraser" data-toggle="tooltip" data-placement="top" title="Estado: Borrador"></i> @else <i class="fas fa-globe-americas" data-toggle="tooltip" data-placement="top" title="Estado: Publico"></i> @endif</td>
                                <td>{{ $p->cat->name }}</td>
                                <td>${{ $p->price }}</td>
                                <td>
                                    @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'products_edit'))
                                         <a href="{{ url('/admin/product/'.$p->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                    @endif
                                </td>
                                <td>
                                    @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'products_delete'))
                                        <a href="{{ url('/admin/product/'.$p->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                    @endif
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
