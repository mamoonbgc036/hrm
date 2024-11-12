@extends('layouts.app')
@section('title','Edit Sub-Department')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Sub Department</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('sub-department.update',$subDepartment->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i> Edit Sub-Department</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('sub-department.index' )}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall"> Department Name</label>
                        <select class="form-control demoSelect" id="department_id" name="department_id" required="" value="{{ old('department_id') }}">
                            <option disabled selected hidden>Select one</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}" {{$department->id==$subDepartment->department_id ? 'selected' : ''}}>{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Sub Department Name</label>
                        <input class="form-control" id="inputSmall" type="text" name="name" value="{{$subDepartment->name}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="demoSelect">Status</label>
                        <select class="form-control form-control-sm demoSelect" id="demoSelect" name="status">
                            <option disabled>Select Status</option>
                            <option value="active"  {{$subDepartment->status=='active' ? 'selected' : ''}}>Active</option>
                            <option value="inactive"  {{$subDepartment->status=='inactive' ? 'selected' : ''}}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">

                </div>
            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="submit">Update</button>
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

        $('.demoSelect').select2();
    </script>
@endsection
