@extends('forone::layouts.master')

@section('main')

    {!! Html::list_header([
    'New'=>true,
    ]) !!}

    {!! Html::datagrid($results) !!}

@stop