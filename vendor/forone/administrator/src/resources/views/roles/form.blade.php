@if(!isset($edit))
{!! Form::group_text('name','Role Name','please enter role name') !!}
@endif
{!! Form::group_text('display_name','Display Name','please enter role display name') !!}
{!! Form::group_text('description','Description','please enter role description') !!}

@section('js')
    @parent
@stop