@extends('layouts.app')
@section('title','Edit User')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>User</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            {{-- <li class="breadcrumb-item"><a href="#">Blank Page</a></li>--}}
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('user.update',$user->id)}}" method="POST" class="form-group">
            @csrf
            @method('put')
            <div class="tile-title-w-btn">
                <h3 class="title">Edit User</h3>
                <p>
                    <a class="btn btn-primary btn-sm icon-btn" href="{{route('user.index')}}"><i class="fa fa-list"></i>See List</a>
                </p>
            </div>

            {{--{{ Form::text('name', null, $user->name, ['class'=>'form-control input-sm']) }}
            {{ Form::text('email', null,  $user->email, ['class'=>'form-control input-sm']) }}
            {{ Form::password('password', null, ['class'=>'form-control input-sm']) }}
            {{ Form::password('password_confirmation', null, ['class'=>'form-control input-sm']) }}
            {{ Form::select('roles[]', 'Roles', $roles, $selected_roles ?? '', ['class'=>'form-control input-sm demoSelect']) }}

            {{ Form::submit('Submit') }}--}}

            <div class="form-group">
                {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                <div>
                    {{ Form::text('name', $user->name, ['class' => 'form-control input-sm', 'id' => 'name']) }}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::email('email', $user->email, ['class' => 'form-control input-sm', 'id' => 'email']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::password('password', ['class' => 'form-control input-sm', 'id' => 'password']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::password('password_confirmation', ['class' => 'form-control input-sm', 'id' => 'password_confirmation']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('roles[]', 'Roles', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::select('roles[]', $roles,  $selected_roles ?? '', ['class' => 'form-control input-sm demoSelect', 'id' => 'roles[]']) !!}
                </div>
            </div>

            <div class="form-group">
                <div>
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </form>


    </div>
@endsection
@section('js')
    <script type="text/javascript"
            src="{{url(asset('assets/admin/js/plugins/bootstrap-datepicker.min.js'))}}'))}}"></script>
    <script type="text/javascript" src="{{url(asset('assets/admin/js/plugins/select2.min.js'))}}"></script>
    <script type="text/javascript" src="{{url(asset('assets/admin/js/plugins/bootstrap-datepicker.min.js'))}}"></script>
    <script type="text/javascript">
        $('#sl').on('click', function () {
            $('#tl').loadingBtn();
            $('#tb').loadingBtn({text: "Signing In"});
        });

        $('#el').on('click', function () {
            $('#tl').loadingBtnComplete();
            $('#tb').loadingBtnComplete({html: "Sign In"});
        });

        $('#demoDate').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });

        /*$('#demoSelect').select2();*/
    </script>
@endsection
