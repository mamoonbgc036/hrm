@extends('layouts.app')
@section('title', 'Specialized Skills')
@section('content')
    <div class="container mt-5">
        <!-- Nav Tabs -->
        <ul class="nav nav-tabs" id="hourlyRateTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link @if (!@$editMode) active @endif" id="all-hourly-rate-tab" data-toggle="tab"
                    href="#all-hourly-rate" role="tab" aria-controls="all-hourly-rate" aria-selected="true">All
                    Specialized Skills</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (@$editMode) active @endif" id="set-hourly-rate-tab"
                    data-toggle="tab" href="#set-hourly-rate" role="tab" aria-controls="set-hourly-rate"
                    aria-selected="false">
                    @if (@$editMode)
                        Update Specialized Skills
                    @else
                        Create Specialized Skills
                    @endif
                </a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="hourlyRateTabContent">
            <!-- All Hourly Rate Tab -->
            <div class="tab-pane fade @if (!@$editMode) show active @endif" id="all-hourly-rate"
                role="tabpanel" aria-labelledby="all-hourly-rate-tab">
                <div class="mt-3">
                    <h4>All Specialized Skills</h4>
                    <table class="table table-bordered" id="hourlyRateTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <!-- Set Hourly Rate Tab -->
            <div class="tab-pane @if (@$editMode) show active @endif fade" id="set-hourly-rate"
                role="tabpanel" aria-labelledby="set-hourly-rate-tab">
                <div class="mt-3">
                    @if (!@$editMode)
                        <h4>Create Specialized Skills</h4>
                        <form action="{{ route('specialized.store') }}" method="POST">
                            @csrf
                        @else
                            <h4>Update Specialized Skills</h4>
                            <form action="{{ route('specialized.update', $specialized->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                    @endif
                    <div class="form-group">
                        <label for="employeeName">Name</label>
                        <input type="text" name="name" value="{{ @$specialized->name }}" class="form-control"
                            id="employeeName" placeholder="">
                    </div>
                    <button type="submit"
                        class="btn btn-primary">{{ @$editMode ? 'Update Skill' : 'Create Skill' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#hourlyRateTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('specialized.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        });
    </script>
@endsection
