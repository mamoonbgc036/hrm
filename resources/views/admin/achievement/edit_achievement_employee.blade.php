@extends('layouts.app')
@section('title','Edit Achievement Employee')
@push('css')
    <style>
        label{
            font-size: 1em !important;
        }
    </style>
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Edit Achievement Employee </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">

        {{--{{ $pivot->id }}--}}
        <form action="{{route('update-achievement-employee')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i> Edit <span style="color: blue;">{{ $achievement->achievement_name }}</span> Details for Employee </h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('achievement.show',$achievement->id)}}"><i class="fa fa-backward"></i>Back To Achievement</a></p>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <input type="hidden" value="{{ $pivot->id }}" name="pivot_id">
                        <input type="hidden" value="{{ $achievement->id }}" name="achievement_id">
                        <label class="col-form-label" for="memo_no">Memo No</label>
                        <input class="form-control" id="memo_no" type="text" name="memo_no" placeholder="memo number" value="{{ old('memo_no',$pivot->memo_no) }}">
                        @error('memo_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="memo_date">Memo Date</label>
                        <input class="form-control demoDate" id="memo_date" name="memo_date" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{ old('memo_date',$pivot->memo_date ? \Carbon\Carbon::parse($pivot->memo_date)->format('d-m-Y') : '') }}">
                        @error('memo_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="date">Date</label>
                        <input class="form-control demoDate" id="date" name="date" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{ old('date',$pivot->date ? \Carbon\Carbon::parse($pivot->date)->format('d-m-Y') : '') }}">
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="issue_authorities">Issue Authorities</label>
                        <input class="form-control" id="issue_authorities" name="issue_authorities" type="text" placeholder="issue authorities" autocomplete="off" value="{{ old('issue_authorities',$pivot->issue_authorities) }}">
                        @error('issue_authorities')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Previous Attachment</label>
                        <div>
                            @if($pivot->attachment_file)
                                <a class="form-control" href=" {{route('achievement.attachment.file',$pivot->id)}}">
                                    <button type="button" class="btn btn-sm btn-link text-info">{{ $pivot->attachment_file }}</button>
                                </a>
                            @else
                                <span class="text-danger">No File Previously Uploaded !!</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="attachment">Attachment</label>
                        <input onchange="onFileChange()" class="form-control" id="attachment" name="attachment" type="file">
                        @error('attachment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="col-form-label" for="description">Description</label>
                        <textarea class="form-control" rows="3" id="description" name="description" placeholder="DESCRIPTION">{{ old('description',$pivot->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')

@endsection
