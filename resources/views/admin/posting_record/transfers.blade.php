@extends('layouts.app')
@section('title', 'Transfers')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>Transferred Job History</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Transfer List</h4>
                </div>
                <div class="tile-body">

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>EMPLOYEE NAME</th>
                                    <th>PIN</th>
                                    <th>OFFICE/STATION NAME</th>
                                    <th>DESIGNATION</th>
                                    <th>GRADE</th>
                                    <th>FROM</th>
                                    <th>TO</th>
                                    <th>DURATION</th>
                                    <th>DESCRIPTION</th>
                                    <th class="text-center" style="width: 10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($transfer_records as $index=>$row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ App\Classes\StringConversion::stringUpperArray($row->employee->name ?? '') }}
                                        </td>
                                        <td>{{ App\Classes\StringConversion::stringUpperArray($row->employee->pin_no ?? '') }}
                                        </td>
                                        <td>{{ App\Classes\StringConversion::stringUpperArray($row->station->name ?? '') }}
                                        </td>
                                        <td>{{ App\Classes\StringConversion::stringUpperArray($row->designation->en_name ?? '') }}
                                        </td>
                                        <td>{{ App\Classes\StringConversion::stringUpperArray($row->grade->grade ?? '') }}
                                        </td>
                                        <td>{{ $row->from_date ?? '' }}</td>
                                        <td>{{ $row->to_date ? $row->to_date : 'Present' }}</td>
                                        <td>{{ App\Classes\StringConversion::stringUpperArray($row->duration ?? '') }}</td>
                                        <td>{{ App\Classes\StringConversion::stringUpperArray($row->description ?? '') }}
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                @can('Job history edit')
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('posting-record.edit', $row) }}" data-toggle="tooltip"
                                                        title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                                @endcan
                                                @can('Job history delete')
                                                    <form method="POST"
                                                        action="{{ route('posting-record.destroy', $row->id) }}"
                                                        class="">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-name="{{ $row->name }}" type="submit"
                                                            class="btn btn-sm btn-danger delete-confirm" data-toggle="tooltip"
                                                            title="Delete"><i class="fa fa-lg fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Data table plugin-->


@endsection
@push('script')
    <!-- page script -->
@endpush
