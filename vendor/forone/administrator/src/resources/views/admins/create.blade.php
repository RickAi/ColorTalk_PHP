@extends('forone::layouts.master')

@section('title', 'create'.$page_name)

@section('main')

    {!! Form::panel_start('create'.$page_name) !!}
    @if (Input::old())
        {!! Form::model(Input::old(),['url'=>'admin/'.$uri,'class'=>'form-horizontal']) !!}
    @else
        {!! Form::open(['url'=>'admin/'.$uri,'class'=>'form-horizontal']) !!}
    @endif
    @include('forone::'. $uri.'.form')
    {!! Form::panel_end('save') !!}
    {!! Form::close() !!}

@stop