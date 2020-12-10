@extends('admin.master')

@section('title', 'Categorias')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/categories/0') }}"><i class="fas fa-folder-open"></i> Categorias</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="panel shadow">
                    <div class="header">
                            <h2 class="title"><i class="fas fa-edit"></i> Editar Categoria</h2>
                    </div>
                    <div class="inside">
                        <div class="container">
                            {!! Form::open(['url' => '/admin/category/'.$cat->id.'/edit', 'files' => true]) !!}
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                {!! Form::text('name', $cat->name,['class' => 'form-control']) !!}
                            </div>
                            <label class="mt-3" for="module">Módulo:</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                                {!! Form::select('module', getModulesArray(), $cat->module, ['class' => 'form-select']) !!}
                            </div>
                            <label class="mt-3" for="icono">Icono:</label>
                            <div class="input-group mb-3">
                                {!! Form::file('icono', ['class' => 'form-control' ,'id' => 'customFile', 'accept' => 'image/*']) !!}
                            </div>
                            {!! Form::submit('Editar', ['class'=>'btn btn-primary mt-3']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            @if(!is_null($cat->icono))
                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-edit"></i> Icono</h2>
                        </div>
                        <div class="inside">
                            <div class="container">
                                <img src="{{ url('/uploads/'.$cat->file_path.'/'.$cat->icono) }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
