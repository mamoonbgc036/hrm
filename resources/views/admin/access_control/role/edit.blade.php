@extends('layouts.app')
@section('title','Edit Role')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>Role </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            {{-- <li class="breadcrumb-item"><a href="#">Blank Page</a></li>--}}
        </ul>
    </div>
    <div class="tile">
        {!! Form::open(['route' => ['role.update',$model->id],'class'=>'form-horizontal', 'method' => 'PUT']) !!}
        <div class="tile-title-w-btn">
            <h3 class="title">Edit Role</h3>
            <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('role.index')}}"><i class="fa fa-list"></i>See
                    List</a></p>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                {{--{!! Form::text('name', 'Role Name (Must be unique)', null,
                ['placeholder'=>'Enter name','required'=>'required'] ) !!}--}}

                <div class="form-group">
                    {!! Form::label('name', 'Role Name (Must be unique)', ['class' => 'control-label']) !!}
                    <div>
                        {!! Form::text('name', $model->name, ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => 'required', 'id' => 'name']) !!}
                    </div>
                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <h3>All Permissions: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <label style="font-size: 20px;" for="checkAll"><input type="checkbox" {{ $all_permissions == count($rolePermissions) ? 'checked' : '' }} id="checkAll" name="checkAll">&nbsp Select All</label></h3>

                @foreach($permission_groups as $key => $permissions)
                    <div class="card my-2">
                        <div class="card-header">
                            <strong class="text-uppercase">{{ $key }}</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <div class="custom-control custom-checkbox mb-2">
                                            <label>{{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $rolePermissions) ? true : false, array('class' => 'name'), ['class' => 'custom-control-input']) }}
                                                {{ $permission->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                {!! Form::submit('Submit',['class'=>'btn btn-primary']); !!}
            </div>
        </div>

        {!! Form::close() !!}

    </div>

@endsection
@push('script')

    <script>
        $(function () {
            $('#checkAll').click(function(event) {
                if(this.checked) {
                    $('input').each(function() {
                        this.checked = true;
                    });
                }else{
                    $('input').each(function() {
                        this.checked = false;
                    });
                }
            });
        })
    </script>

@endpush
