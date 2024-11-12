@extends('layouts.app')
@section('title','Add User')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>User</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('user.store')}}" method="POST" class="form-group">
            @csrf
            <div class="tile-title-w-btn">
                <h3 class="title">Create New User</h3>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('user.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            {{--{{ Form::text('name', null, null, ['class'=>'form-control input-sm']) }}
            {{ Form::text('email', null, null, ['class'=>'form-control input-sm']) }}
            {{ Form::password('password', null, ['class'=>'form-control input-sm']) }}
            {{ Form::password('password_confirmation', null, ['class'=>'form-control input-sm']) }}
            {{ Form::select('roles[]', 'Roles', $roles, $selected_roles ?? '', ['class'=>'form-control input-sm demoSelect']) }}--}}


            <div class="form-group">
                {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                <div>
                    {{ Form::text('name', null, ['class' => 'form-control input-sm', 'id' => 'name']) }}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::email('email', null, ['class' => 'form-control input-sm', 'id' => 'email']) !!}
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
                {!! Form::label('roles', 'Roles', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::select('roles[]', $roles,  $selected_roles ?? '', ['class' => 'form-control input-sm demoSelect', 'id' => 'roles[]']) !!}
                </div>
            </div>

            <div class="form-group">
                <div>
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

            {{--{{ Form::submit('Submit') }}--}}
        </form>


    </div>
    </section>
    <!-- /.content -->


@endsection
@section('script')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>


@endsection
@push('script-bottom')

    <script>
        $(function () {
            //Initialize Select2 Elements
            /*$('.select2').select2()*/

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })


        })
    </script>
@endpush
