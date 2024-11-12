@extends('layouts.app')
@section('title', 'Edit Department')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Department</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{ route('department.update', $department->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i> Edit Department</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{ route('department.index') }}"><i
                            class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="inputSmall" type="text"
                            name="name" value="{{ old('name', $department->name) }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="demoSelect">Status</label>

                        <select class="form-control form-control-sm" id="demoSelect" name="status">
                            <option value="" selected disabled>Select Status</option>
                            <option value="Active" {{ $department->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $department->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{ url(asset('assets/admin/js/plugins/select2.min.js')) }}"></script>
    {{-- <script type="text/javascript">
        $('#demoSelect').select2();
    </script> --}}
@endsection
