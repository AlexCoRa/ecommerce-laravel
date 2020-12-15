@extends('admin.master')

@section('title', 'Categorias')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/categories/0') }}"><i class="fas fa-folder-open"></i> Categorias</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'category_add'))
                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus"></i> Añadir Categoria</h2>
                        </div>
                        <div class="inside">
                            <div class="container">
                                {!! Form::open(['url' => '/admin/category/add', 'files' => true]) !!}
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    {!! Form::text('name', null,['class' => 'form-control']) !!}
                                </div>
                                <label class="mt-3" for="module">Módulo:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                                    {!! Form::select('module', getModulesArray(), 0, ['class' => 'form-select']) !!}
                                </div>
                                <label class="mt-3" for="icono">Icono:</label>
                                <div class="input-group mb-3">
                                    {!! Form::file('icono', ['class' => 'form-control', 'required' ,'id' => 'customFile', 'accept' => 'image/*']) !!}
                                </div>
                                {!! Form::submit('Guardar', ['class'=>'btn btn-success mt-3']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-folder-open"></i> Categorias</h2>
                    </div>
                    <div class="inside">
                        <div class="container">
                            <div class="nav nav-pills nav-fill">
                                @foreach(getModulesArray() as $m => $k)
                                    <a href="{{ url('/admin/categories/'.$m) }}" class="link-a nav-link">{{ $k }}</a>
                                @endforeach
                            </div>
                            <table class="table table-striped mt-2">
                                <thead>
                                <tr>
                                    <th scope="col">Icono</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($cats as $cat)
                                        <tr>
                                            <td>
                                                @if(!is_null($cat->icono))
                                                    <img width="50px" src="{{ url('/uploads/'.$cat->file_path.'/'.$cat->icono) }}" alt="" class="img-fluid">
                                                @endif
                                            </td>
                                            <td>{{ $cat->name }}</td>
                                            <td>
                                                @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'category_edit'))
                                                    <a href="{{ url('/admin/category/'.$cat->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'category_delete'))
                                                     <a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
