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
                        <a href="#" id="btn_search">
                            <i class="fas fa-search"></i> Buscar
                        </a>
                    </li>
                </ul>
            </div>
            <div class="inside">
                <div class="container">
                    <div class="form_search" id="form_search">
                        {!! Form::open(['url' => '/admin/product/search']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::text('search', null, ['class'=> 'form-control', 'placeholder'=> 'Buscar', 'required']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('filter', ['0' => 'Nombre del producto', '1' => 'Código'], '0', ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::select('status', ['0' => 'Borrador', '1' => 'Público'], '0', ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <table class="table table-striped mt-2">
                        <thead>
                        <tr>
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
                                <td><a href="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}" data-fancybox="gallery"><img src="{{ url('/uploads/'.$p->file_path.'/t_'.$p->image) }}" style="width: 25%" ></a></td>
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
                                        @if(is_null($p->deleted_at))
                                            <a href="#"
                                               class="btn_deleted"
                                               data-action="delete"
                                               data-path="admin/product"
                                               data-object="{{ $p->id }}"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        @else
                                            <a href="{{ url('/admin/product/'. $p->id.'/restore') }}"
                                               class="btn_deleted"
                                               data-action="restore"
                                               data-path="admin/product"
                                               data-object="{{ $p->id }}"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Restaurar">
                                                <i class="fas fa-trash-restore"></i>
                                            </a>
                                        @endif
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
