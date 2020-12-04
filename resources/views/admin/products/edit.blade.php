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
                                            <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                            {!! Form::text('name', $p->name,['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="category">Categoría:</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                                            {!! Form::select('category', $cats, $p->category_id, ['class' => 'form-select']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="price">Precio:</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                            {!! Form::number('price', $p->price,['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
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
                                           {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], $p->in_discount, ['class' => 'form-select']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="discount">Descuento:</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                                            {!! Form::number('discount', $p->discount,['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="status">Estado:</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="fas fa-search-dollar"></i></div>
                                            {!! Form::select('status', ['0' => 'Borrador', '1' => 'Publico'], $p->status, ['class' => 'form-select']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label for="inventory">Inventario:</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="fas fa-dolly-flatbed"></i></div>
                                            {!! Form::number('inventory', $p->inventory, ['class' => 'form-control', 'min' => '0.00']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="code">Código de Sistema:</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="fas fa-qrcode"></i></div>
                                            {!! Form::text('code', $p->code,['class' => 'form-control']) !!}
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
                <div class="panel shadow mt-2">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-images"></i> Galeria</h2>
                    </div>
                    <div class="inside">
                        <div class="container product_gallery">
                            @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'product_gallery_add'))
                                {!! Form::open(['url' => '/admin/product/'.$p->id.'/gallery/add', 'files' => true, 'id' => 'form_product_gallery']) !!}
                                {!! Form::file('file_image', ['id' => 'product_file_image', 'accept' => 'image/*',
                                                    'style' => 'display:none;', 'required']) !!}
                                {!! Form::close() !!}
                                <div class="btn-submit">
                                    <a href="#" id="btn_product_file_image"><i class="fas fa-plus"></i></a>
                                </div>
                            @endif
                            <div class="tumbs">
                                @foreach($p->getGallery as $img)
                                    <div class="tumb">
                                        @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'product_gallery_add'))
                                            <a href="{{ url('/admin/product/'.$p->id.'/gallery/'.$img->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                        @endif
                                        <img src="{{ url('/uploads/'.$img->file_path.'/t_'.$img->file_name) }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
