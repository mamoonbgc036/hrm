@extends('layouts.app')
@section('title','Edit Nominee')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Nominee</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('nominee.update',$nominee)}}" method="post">
            @csrf
            @method('PUT')
            <div class="tile-title-w-btn">
                <h4 class="title float-left"><i class="fa fa-edit"></i> Edit Nominee</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('nominee.index')}}"><i class="fa fa-list"></i> See List</a></p>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Nominee Name</label>
                        <input class="form-control" id="inputSmall" type="text"  name="name" value="{{$nominee->name}}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Relationship</label>
                        <select name="relationship_id" id="relationship"
                                class="form-control" required>
                            @foreach($relationship as $row)
                                <option value="{{$row->id}}" {{$row->id==$nominee->relationship_id ? 'selected':''}}>{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Nid</label>
                        <input class="form-control" id="inputSmall" type="text"  name="nid_no" value="{{$nominee->nid_no}}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Percentage(%)</label>
                        <input class="form-control" id="inputSmall" type="text"  name="percentage" value="{{$nominee->percentage}}">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Permanent Address</label>
                        <textarea class="form-control" rows="3" name="permanent_address">{{$nominee->permanent_address}}</textarea>
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

@endsection
