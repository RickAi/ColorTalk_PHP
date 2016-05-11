@extends('forone::layouts.master')

@section('main')

    {!! Html::list_header([
    'title' => '试题详细',
    ]) !!}

    <div class="table-responsive">
        <table class="table">
            <tbody>
            {{--题目信息--}}
            <tr class="info">
                <th>题目信息</th>
                <th></th>
            </tr>

            {{--答案信息--}}
            <tr class="info">
                <th>答案信息</th>
                <th></th>
            </tr>
            </tbody>

        </table>
    </div>

@stop