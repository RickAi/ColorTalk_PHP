@if(!isset($edit))
{!! Form::group_text('name','System Name','Please enter system name') !!}
@endif
{!! Form::group_text('display_name','Display Name','please enter display name') !!}
{!! Form::group_text('description','Description','please enter description') !!}

@section('js')
    @parent
@stop