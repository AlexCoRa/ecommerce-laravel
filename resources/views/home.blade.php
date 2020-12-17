@extends('master')

@section('title', 'Inicio')

@section('content')
    <section>
        <div class="home_action_bar shadow">
            <div class="row">
                <div class="col-md-3">
                    <div class="categories">
                        <a href="#"><i class="fas fa-stream"></i> Categorías</a>
                        <ul class="shadow">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ url('/store/category/'.$category->id.'/'.$category->slug) }}">
                                        <img src="{{ url('/uploads/'.$category->file_path.'/'.$category->icono) }}" alt="">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    {!! Form::open(['url' => '/search']) !!}
                        <div class="input-group">
                            <i class="fas fa-search"></i>
                            {!! Form::text('search_query', null, ['class' => 'form-control', 'placeholder' => '¿Qué estás buscando?', 'required']) !!}
                            {!! Form::submit('Buscar', ['class' => 'btn btn-outline-secondary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
    <section>
        @include('components.slider_home')
    </section>
    <section>
        <div class="products_list" id="products_list">

        </div>
    </section>
@endsection
