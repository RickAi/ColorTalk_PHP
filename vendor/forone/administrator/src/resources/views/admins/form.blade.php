
{!! Form::group_text('name','User Name','please enter user name') !!}
{!! Form::group_text('email','Email','please enter email') !!}

@if (str_is('admin.admins.create', Route::current()->getName()))
    {!! Form::group_password('password', 'Password','please enter password') !!}
@endif

@section('js')
    @parent
@stop