@extends('admin.master')

@section('title', 'Configuraciones')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/settings') }}"><i class="fas fa-cogs"></i> Configuraciones</a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-cogs"></i> Configuraciones</h2>
            </div>
            <div class="inside">
                <div class="container">
                    {!! Form::open(['url' => '/admin/settings']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Nombre de la tienda:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-store"></i></div>
                                    {!! Form::text('name', \Illuminate\Support\Facades\Config::get('gentleman.name'),['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="currency">Moneda:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-search-dollar"></i></div>
                                    {!! Form::text('currency', \Illuminate\Support\Facades\Config::get('gentleman.currency'),['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="company_phone">Teléfono:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-phone"></i></div>
                                    {!! Form::number('company_phone', \Illuminate\Support\Facades\Config::get('gentleman.company_phone'),['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="map">Ubicaciones:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
                                    {!! Form::text('map', \Illuminate\Support\Facades\Config::get('gentleman.map'),['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="maintenance_mode">Modo mantenimiento:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-wrench"></i></div>
                                    {!! Form::select('maintenance_mode', ['0' => 'Desactivado', '1' => 'Activado'], \Illuminate\Support\Facades\Config::get('gentleman.maintenance_mode'), ['class' => 'form-select']) !!}
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="products_per_page">Productos para mostrar por pagina:</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-list"></i></div>
                                    {!! Form::number('products_per_page', \Illuminate\Support\Facades\Config::get('gentleman.products_per_page'),['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
