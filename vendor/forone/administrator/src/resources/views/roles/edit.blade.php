@extends('forone::layouts.master')

@section('title', 'Update '.$page_name)

@section('main')

    {!! Form::panel_start('edit'.$page_name) !!}
    {!! Form::model($data,['method'=>'PUT','route'=>['admin.'.$uri.'.update',$data->id],'class'=>'form-horizontal']) !!}
        @include('forone::' . $uri.'.form', ['edit'=>true])
    {!! Form::panel_end('create') !!}
    {!! Form::close() !!}

@stop