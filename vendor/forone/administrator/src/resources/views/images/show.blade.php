@extends('forone::layouts.master')

@section('main')

    {!! Html::list_header([
    'title' => 'Image detail',
    ]) !!}

    <div class="table-responsive">
        <table class="table">
            <tbody>
            <tr class="info">
                <th>User ID</th>
                <th>{!! $image_data["user_id"] !!}</th>
            </tr>

            <tr class="info">
                <th>Image Type</th>
                <th>{!! $image_data["type"] !!}</th>
            </tr>

            <tr class="info">
                <th>Image Content</th>
                <th><img class="img-responsive"
                         src="{!!  $image_data["url"] !!}"></th>
            </tr>
            </tbody>

        </table>
    </div>

@stop