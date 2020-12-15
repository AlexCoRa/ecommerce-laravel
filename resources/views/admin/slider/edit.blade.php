@extends('admin.master')

@section('title', 'Listar Sliders')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/sliders') }}"><i class="fas fa-images"></i> Editar Slider</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'slider_edit'))
                <div class="col-md-8">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-edit"></i> Editar Slider</h2>
                        </div>
                        <div class="inside">
                            <div class="container">
                                {!! Form::open(['url' => '/admin/slider/'.$slider->id.'/edit']) !!}
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    {!! Form::text('name', $slider->name,['class' => 'form-control']) !!}
                                </div>
                                <label class="mt-3" for="visible">Visible:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-eye"></i></div>
                                    {!! Form::select('visible', ['0' => 'No visible', '1' => 'Visible'], $slider->status, ['class' => 'form-select']) !!}
                                </div>
                                <label class="mt-3" for="img">Imagen:</label>
                                <div class="input-group mb-3">
                                   <div class="row">
                                       <div class="col-md-4">
                                           <img src="{{ url('/uploads/'.$slider->file_path.'/'.$slider->file_name) }}" class="img-fluid">
                                       </div>
                                   </div>
                                </div>
                                <label for="name">Contenído:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    {!! Form::textarea('content', html_entity_decode($slider->content),['class' => 'form-control', 'rows' => '3']) !!}
                                </div>
                                <label class="mt-3" for="sorder">Orden de aparición:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    {!! Form::number('sorder', $slider->sorder,['class' => 'form-control', 'min' => '0']) !!}
                                </div>
                                {!! Form::submit('Editar', ['class'=>'btn btn-success mt-3']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
