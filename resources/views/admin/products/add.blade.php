@extends('admin.master')

@section('title', 'Agregar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i> Productos</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/product/add') }}"><i class="fas fa-plus"></i>Agregar Producto</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-plus"></i> Agregar Producto</h2>
            </div>
            <div class="inside">
                <div class="container">
                    {!! Form::open(['url' => '/admin/product/add', 'files'=>true]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Nombre del Producto:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    </div>
                                    {!! Form::text('name', null,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="category">Categoría:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                                    </div>
                                    {!! Form::select('category', $cats, 0, ['class' => 'custom-select']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="price">Precio:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                    </div>
                                    {!! Form::number('price', null,['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <label for="img">Imagen:</label>
                                <div class="custom-file">
                                    {!! Form::file('img', ['class' => 'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*']) !!}
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="indiscount">¿En Descuento?:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-search-dollar"></i></div>
                                    </div>
                                   {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], 0, ['class' => 'custom-select']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="discount">Descuento:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                                    </div>
                                    {!! Form::number('discount', 0.00,['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="content">Descripción:</label>
                                {!! Form::textarea('content', null, ['class' => 'form-control', 'id'=>'editor']) !!}
                            </div>
                        </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
