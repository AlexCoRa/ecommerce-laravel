@extends('admin.master')

@section('title', 'Categorias')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}"><i class="fas fa-folder-open"></i> Categorias</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i> Añadir Categoria</h2>
                    </div>
                    <div class="inside">
                        <div class="container">
                            {!! Form::open(['url' => '/admin/category/add']) !!}
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                </div>
                                {!! Form::text('name', null,['class' => 'form-control']) !!}
                            </div>
                            <label class="mt-3" for="module">Módulo:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                                </div>
                                {!! Form::select('module', getModulesArray(), 0, ['class' => 'custom-select']) !!}
                            </div>
                            <label class="mt-3" for="icon">Ícono:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-icons"></i></div>
                                </div>
                                {!! Form::text('icon', null,['class' => 'form-control']) !!}
                            </div>
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mt-3']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
