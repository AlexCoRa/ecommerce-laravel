@extends('connect.master')

@section('title', 'Login')

@section('content')
<div class="box">
    {!! Form::open(['url' => '/login']) !!}
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
        </div>
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>
    {!! Form::close() !!}
</div>
@stop

