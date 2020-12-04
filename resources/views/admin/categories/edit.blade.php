@extends('admin.master')

@section('title', 'Categorias')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/categories/0') }}"><i class="fas fa-folder-open"></i> Categorias</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                            <h2 class="title"><i class="fas fa-edit"></i> Editar Categoria</h2>
                    </div>
                    <div class="inside">
                        <div class="container">
                            {!! Form::open(['url' => '/admin/category/'.$cat->id.'/edit']) !!}
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
                            <label class="mt-3" for="icono">Ícono:</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-icons"></i></div>
                                {!! Form::text('icono', $cat->icono,['class' => 'form-control']) !!}
                            </div>
                            {!! Form::submit('Editar', ['class'=>'btn btn-primary mt-3']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
