@extends('admin.master')

@section('title', 'Agregar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i> Productos</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/product/add') }}"><i class="fas fa-plus"></i> Agregar Producto</a></li>
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
                            <div class="col-md-4">
                                <label for="name">Nombre del Producto:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    {!! Form::text('name', null,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="category">Categoría:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                                    {!! Form::select('category', $cats, 0, ['class' => 'form-select']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="price">Precio:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                    {!! Form::number('price', null,['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="inventory">Inventario:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-dolly-flatbed"></i></div>
                                    {!! Form::number('inventory', 0, ['class' => 'form-control', 'min' => '0.00']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="img">Imagen:</label>
                                <div class="input-group mb-3">
                                    {!! Form::file('img', ['class' => 'form-control', 'id' => 'customFile', 'accept' => 'image/*']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="indiscount">¿En Descuento?:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-search-dollar"></i></div>
                                   {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], 0, ['class' => 'form-select']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="discount">Descuento:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                                    {!! Form::number('discount', 0.00,['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="code">Código de Sistema:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-qrcode"></i></div>
                                    {!! Form::text('code', 0,['class' => 'form-control']) !!}
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
