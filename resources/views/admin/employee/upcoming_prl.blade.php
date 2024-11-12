@extends('layouts.app')
@section('title','Upcoming PRL List')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Employee</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i>Upcoming PRL Employee List</h4>
                </div>
                <div>
                    @can('Employee export button')
                        <a href="{{route('employees.export')}}" class="btn btn-success btn-sm float-right mb-2 mr-1"
                           data-toggle="tooltip" title="Export"><i class="fa fa-file-excel" aria-hidden="true"></i>Export</a>
                    @endcan
                    @can('Employee search button')
                        <a href="{{route('employee.search')}}" class="btn btn-info btn-sm float-right mb-2 mr-1 ml-1"
                           data-toggle="tooltip" title="Search"><i class="fa fa-search" aria-hidden="true"></i>Search</a>
                    @endcan
                    @can('Employee deleted button')
                        <a href="{{route('employee.deleted')}}" class="btn btn-danger btn-sm float-right mb-2 ml-1"
                           data-toggle="tooltip" title="Show Deleted"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Deleted Employees</a>
                    @endcan
                    @can('Employee create')
                        <a href="{{route('employee.create')}}" class="btn btn-primary btn-sm float-right mb-2 ml-1"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Employee</a>
                    @endcan
                    @can('Employee list')
                        <a href="{{route('employee.index')}}" class="btn btn-info btn-sm float-right mb-2 ml-1"
                           data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i>All Employees</a>
                    @endcan
                    @can('Employee prl list')
                        <a href="{{route('employee.prl-list')}}" class="btn btn-dark btn-sm float-right mb-2 ml-1"
                           data-toggle="tooltip" title="PRL List"><i class="fa fa-plus-square-o" aria-hidden="true"></i>PRL List</a>
                    @endcan
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable2">
                            <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Name</th>
                                <th>PIN</th>
                                <th>Designation</th>
                                <th>Office/Station</th>
                                <th>Date of Join</th>
                                <th>Date of PRL</th>
                                <th>Batch No</th>
                                <th class="text-center" style="width: 10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($upcoming_prl as $employee)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$employee->name}}</td>
                                        <td>{{$employee->pin_no}}</td>
                                        <td>{{$employee->designation->en_name ?? ''}}</td>
                                        <td>{{$employee->jobStation->name ?? ''}}</td>
                                        <td>{{\Carbon\Carbon::parse($employee->join_date)->format('d-m-Y') ?? ''}}</td>
                                        <td>{{\Carbon\Carbon::parse($employee->lpr_date)->format('d-m-Y') ?? ''}}</td>
                                        <td>{{$employee->batch_no ? $employee->batch_no.'-'.$employee->batch_no_ext : ''}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @can('Employee show')
                                                    <a class="btn btn-sm btn-primary" href="{{route('employee.show',$employee->id)}}" data-toggle="tooltip" title="Show">
                                                        <i class="fa fa-lg fa-eye"></i></a>
                                                @endcan
                                                {{--<form id="trash" method="POST"
                                                      action="{{ route('employee.permanent-delete',$employee->id)}}" class="">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-name="{{ $employee->name }}" type="submit" class="btn
                                                     btn-danger delete-confirm"><i class="fa fa-lg
                                                     fa-trash"></i></button>
                                                </form>--}}
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
    <script>
        $(document).ready( function (){
            $('#sampleTable2').dataTable({
                /*serverSide: true,
                processing: true,
                ajax: '{{ route('employee.index') }}',
                columns:[
                    {data:"DT_RowIndex",name:"DT_RowIndex", searchable:false, orderable:false},
                    {data:"name", name:'name'},
                    {data:"pin_no", name:'pin_no'},
                    {data:"designation.en_name", name:'designation.en_name', defaultContent: ''},
                    {data:"job_station.name", name:'jobStation.name', defaultContent: '', searchable:false},
                    {data:"join_date",},
                    {data:"batch_no",},
                    {data:"action",searchable:false, orderable:false},
                ]*/
            });
        })
    </script>

@endpush
