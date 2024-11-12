@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item">
                        <a class="btn btn-info text-white m-2" href="{{ route('welfare.create') }}">Create A Welfare Fund</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-info text-white m-2" href="{{ route('welfare.fund.create') }}">Contribution Form</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-info text-white m-2" href="{{ route('welfare.request') }}">Benefit Form</a>
                    </li>
                </ul>
                @yield('welfare')
            </div>
        </div>
    </div>
@endsection
