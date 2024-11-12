@extends('layouts.app')
@section('title','Edit Leave Employee')
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
            <h1><i class="fa fa-users" aria-hidden="true"></i> Edit Leave Employee </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">

        <form action="{{route('update-leave-employee')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-joomla fa-lg"></i>
                    Edit
                    <span class="text-success">
                        {{ $leave->name }}
                    </span>
                    Details for
                    <span class="text-primary">
                        {{ \App\Models\Employee::findOrFail($pivot->employee_id)->name }}
                    </span>
                </h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('leave.show',$leave->id)}}"><i class="fa fa-backward"></i>Back To Leave</a></p>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <input type="hidden" value="{{ $pivot->id }}" name="pivot_id">
                        <input type="hidden" value="{{ $leave->id }}" name="leave_id">
                        <label class="col-form-label" for="memo_no">Memo No</label>
                        <input class="form-control" id="memo_no" type="text" name="memo_no" placeholder="Memo No" value="{{ old('memo_no',$pivot->memo_no) }}">
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
                        <label class="col-form-label" for="from_date">From Date</label>
                        <input class="form-control demoDate" id="from_date" name="from_date" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{ old('from_date',$pivot->from_date ? \Carbon\Carbon::parse($pivot->from_date)->format('d-m-Y') : '') }}">
                        @error('from_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="to_date">To Date</label>
                        <input class="form-control demoDate" id="to_date" name="to_date" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{ old('to_date',$pivot->to_date ? \Carbon\Carbon::parse($pivot->to_date)->format('d-m-Y') : '') }}">
                        @error('to_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="duration">Duration</label>
                        <input class="form-control" id="duration" type="text" readonly name="duration" value="{{ old('duration',$pivot->duration) }}">
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Uploaded Attachment</label>
                        <div>
                            @if($pivot->attachment_file)
                                <a class="form-control" href=" {{route('leave.attachment.file',$pivot->id)}}">
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

    <script>
        $(document).ready(function () {
            $('#from_date').change(function () {
                let _token = "{{ csrf_token() }}";
                let from_date = $('#from_date').val()
                let to_date = $('#to_date').val()
                $.get("{{ Route('fetch-duration2') }}", {_token,from_date: from_date,to_date: to_date}, function(data){
                    $('#duration').val(data.output)
                })
            })
            $('#to_date').change(function () {
                let _token = "{{ csrf_token() }}";
                let from_date = $('#from_date').val()
                let to_date = $('#to_date').val()
                $.get("{{ Route('fetch-duration2') }}", {_token,from_date: from_date,to_date: to_date}, function(data){
                    $('#duration').val(data.output)
                })
            })
        });
    </script>

@endsection
