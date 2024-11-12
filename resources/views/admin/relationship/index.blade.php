@extends('layouts.app')
@section('title','Relationships')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Relationship</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Relationship List</h4>
                </div>
                <div>
                    @can('Relationship deleted button')
                        <a href="{{route('relationship.deleted')}}" class="btn btn-danger btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Deleted List"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Deleted Relationship</a>
                    @endcan
                </div>
                <div>
                    @can('Relationship create')
                        <a href="{{route('relationship.create')}}" class="btn btn-primary btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add Relationship</a>
                    @endcan
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">Sr</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th class="text-center" style="width:10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $index=>$contact)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->description}}</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                @can('Relationship edit')
                                                    <a class="btn btn-sm btn-primary" href="{{route('relationship.edit',$contact)}}"
                                                       data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                                @endcan
                                                @can('Relationship delete')
                                                    <form id="trash" method="POST" action="{{ route('relationship.destroy',$contact->id)}}" class="">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-name="{{ $contact->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
                                                                data-toggle="tooltip" title="Delete"><i class="fa fa-lg fa-trash"></i></button>
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

@endsection
@push('script')
    <!-- page script -->
    <script>

    </script>
@endpush
