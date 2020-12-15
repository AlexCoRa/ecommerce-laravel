@extends('admin.master')

@section('title', 'Listar Sliders')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/sliders') }}"><i class="fas fa-images"></i> Sliders</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'slider_add'))
                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus"></i> Agregar Slider</h2>
                        </div>
                        <div class="inside">
                            <div class="container">
                                {!! Form::open(['url' => '/admin/slider/add', 'files' => true]) !!}
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    {!! Form::text('name', null,['class' => 'form-control']) !!}
                                </div>
                                <label class="mt-3" for="visible">Visible:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-eye"></i></div>
                                    {!! Form::select('visible', ['0' => 'No visible', '1' => 'Visible'], 1, ['class' => 'form-select']) !!}
                                </div>
                                <label class="mt-3" for="img">Imagen:</label>
                                <div class="input-group mb-3">
                                    {!! Form::file('img', ['class' => 'form-control', 'id' => 'customFile', 'accept' => 'image/*']) !!}
                                </div>
                                <label for="name">Contenído:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    {!! Form::textarea('content', null,['class' => 'form-control', 'rows' => '3']) !!}
                                </div>
                                <label class="mt-3" for="sorder">Orden de aparición:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    {!! Form::number('sorder', 0,['class' => 'form-control', 'min' => '0']) !!}
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
                        <h2 class="title"><i class="fas fa-images"></i> Sliders</h2>
                    </div>
                    <div class="inside">
                        <div class="container">
                            <table class="table table-striped mt-2">
                                <thead>
                                <tr>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Contenído</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sliders as $slider)
                                    <tr>
                                        <td width="180px">
                                            <img src="{{ url('/uploads/'.$slider->file_path.'/'.$slider->file_name) }}" class="img-fluid">
                                        </td>
                                        <td>
                                            <div class="slider_content">
                                                <h1>{{ $slider->name }}</h1>
                                                {!! html_entity_decode($slider->content) !!}
                                            </div>
                                        </td>
                                        <td>
                                            @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'slider_edit'))
                                                <a href="{{ url('/admin/slider/'.$slider->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                            @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'slider_delete'))
                                                <a href="#"
                                                   class="btn_deleted"
                                                   data-action="delete"
                                                   data-path="admin/slider"
                                                   data-object="{{ $slider->id }}"
                                                   data-toggle="tooltip"
                                                   data-placement="top" title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
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
