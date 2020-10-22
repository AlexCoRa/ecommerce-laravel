@extends('admin.master')

@section('title', 'Editar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i> Productos</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                 <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-edit"></i> Editar Producto</h2>
                    </div>
                    <div class="inside">
                        <div class="container">
                            {!! Form::open(['url' => '/admin/product/'.$p->id.'/edit', 'files'=>true]) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Nombre del Producto:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                            </div>
                                            {!! Form::text('name', $p->name,['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="category">Categoría:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                                            </div>
                                            {!! Form::select('category', $cats, $p->category_id, ['class' => 'custom-select']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="price">Precio:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                            </div>
                                            {!! Form::number('price', $p->price,['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
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
                                           {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], $p->in_discount, ['class' => 'custom-select']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="discount">Descuento:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                                            </div>
                                            {!! Form::number('discount', $p->discount,['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="status">Estado:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-search-dollar"></i></div>
                                            </div>
                                            {!! Form::select('status', ['0' => 'Borrador', '1' => 'Publico'], $p->status, ['class' => 'custom-select']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="content">Descripción:</label>
                                        {!! Form::textarea('content', $p->content, ['class' => 'form-control', 'id'=>'editor']) !!}
                                    </div>
                                </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-image"></i> Editar Imagen</h2>
                    </div>
                    <div class="inside">
                        <div class="container">
                            <a href="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}" data-fancybox="gallery"><img class="img-fluid" src="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}"></a>
                            <h4 style="font-weight: bold;" class="text-center mt-2">{{ $p->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
