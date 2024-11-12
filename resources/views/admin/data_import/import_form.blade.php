@extends('layouts.app')
@section('title', 'Employee Transfer')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>Data Import</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <form action="{{ route('data.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" required>
                        <button type="submit">Import Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection