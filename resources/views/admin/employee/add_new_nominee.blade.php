@extends('layouts.app')
@section('title','Add Nominee')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Nominee</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div id="nominee" class="tab-pane fade">
        <h3>Add Nominee</h3>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nominee Name</th>
                    <th>Relationship</th>
                    <th>Nid</th>
                    <th>Percentage(%)</th>
                    <th>Permanent Address</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(row,index) in nominee_inputs">
                    <td>
                        <input class="form-control" id="name" :name="'nominees['+index+'][name]'" type="text" >
                    </td>
                    <td>
                        <select :name="'nominees['+index+'][relationship]'" id="relationship" class="form-control" >
                            <option value="" disabled selected>Select All</option>
                            @foreach($relationship as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control" id="nid_no" type="text" :name="'nominees['+index+'][nid_no]'" >
                    </td>

                    <td>
                        <input v-model="percentage[index]" @change="valid" :name="'nominees['+index+'][percentage]'" class="form-control" id="percentage" type="text" >
                    </td>

                    <td>
                        <input type="text" class="form-control" :name="'nominees['+index+'][permanent_address]'" >
                    </td>
                    <td>
                        <button type="button" @click="removeId(index)" class="btn btn-sm btn-danger">Remove</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <button class="btn btn-info" @click.prevent="addMoreNominee">Add More</button>
    </div>
{{--    <div class="tile">--}}
{{--        <form action="{{route('quota.store')}}" method="post">--}}
{{--            @csrf--}}
{{--            <div class="tile-title-w-btn">--}}
{{--                <h4 class="title"><i class="fa fa-plus fa-lg"></i> Add New Nominee</h4>--}}
{{--                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('quota.index')}}"><i class="fa fa-list"></i>See List</a></p>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6 col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="col-form-label col-form-label-sm" for="inputSmall">Name</label>--}}
{{--                        <input class="form-control @error('name') is-invalid @enderror" id="inputSmall" type="text" name="name" value="{{old('name')}}">--}}
{{--                        @error('name')--}}
{{--                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-sm-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="col-form-label col-form-label-sm" for="demoSelect">Status</label>--}}
{{--                        <select class="form-control form-control-sm" id="demoSelect" name="status" value="{{ old--}}
{{--                        ('status') }}" required>--}}
{{--                            <option value="" disabled>Select Status</option>--}}
{{--                            <option value="active">Active</option>--}}
{{--                            <option value="inactive">Inactive</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tile-footer">--}}
{{--                <button class="btn btn-primary" type="submit">Submit</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}

@endsection
@section('js')
    <script type="text/javascript" src="{{url(asset('assets/admin/js/plugins/select2.min.js'))}}"></script>
    <script type="text/javascript">
        /*$('#demoSelect').select2();*/
    </script>
@endsection

