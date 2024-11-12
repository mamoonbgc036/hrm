@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>POPI</h1>
            <p></p>
        </div>
    </div>

    {{-- ---start-----Summary data--- --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <p class="text-muted fw-medium">
                            <h5>Employees</h5>
                            </p>
                            <h4 class="mb-0">{{ $all }}</h4>
                        </div>

                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                            <i class="fa fa-address-book fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <p class="text-muted fw-medium">
                            <h5>PRL</h5>
                            </p>
                            <h4 class="mb-0">{{ $prl }}</h4>
                        </div>

                        <div class="avatar-sm rounded-circle bg-warning align-self-center mini-stat-icon">
                            <i class="fa fa-mortar-board fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <p class="text-muted fw-medium">
                            <h5>Upcoming</h5>
                            </p>
                            <h4 class="mb-0">{{ $upcoming }}</h4>
                        </div>

                        <div class="avatar-sm rounded-circle bg-info align-self-center mini-stat-icon">
                            <i class="fa fa-black-tie fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <p class="text-muted fw-medium">
                            <h5>Stations</h5>
                            </p>
                            <h4 class="mb-0">{{ $stations }}</h4>
                        </div>

                        <div class="mini-stat-icon avatar-sm rounded-circle bg-danger align-self-center">
                            <i class="fa fa-ambulance fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ---end-----Summary data--- --}}

    {{-- ---start-----Charts--- --}}
    <div class="row">

        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Promotion & Transfer </h3>

                <div class="row text-center">
                    <div class="col-6">
                        <h5 class="mb-0">{{ $total_promotion }}</h5>
                        <p class="text-muted text-truncate">Total Promotion</p>
                    </div>
                    <div class="col-6">
                        <h5 class="mb-0">{{ $total_transfer }}</h5>
                        <p class="text-muted text-truncate">Total Transfer</p>
                    </div>
                    {{-- <div class="col-4">
                            <h5 class="mb-0">{{ '' }}</h5>
                            <p class="text-muted text-truncate">@lang('dashboard.all_existing')</p>
                        </div> --}}
                </div>

                <canvas id="barChart" height="250px" style="max-height: 300px;"></canvas>

            </div>
        </div>

        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Award & Achievement</h3>

                <div class="row text-center">
                    <div class="col-6">
                        <h5 class="mb-0">{{ count($awarded_employee) }}</h5>
                        <p class="text-muted text-truncate">Total Award</p>
                    </div>
                    <div class="col-6">
                        <h5 class="mb-0">{{ count($achievement_employee) }}</h5>
                        <p class="text-muted text-truncate">Total Achievement</p>
                    </div>
                </div>

                <canvas id="pieChart" height="250px" style="max-height: 300px;"></canvas>

            </div>
        </div>

        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">All Trainings </h3>

                <div class="row text-center">
                    <div class="col-4">
                        <h5 class="mb-0">{{ count($foreign_trained_employee) }}</h5>
                        <p class="text-muted text-truncate">Abroad Trainings</p>
                    </div>
                    <div class="col-4">
                        <h5 class="mb-0">{{ count($local_trained_employee) }}</h5>
                        <p class="text-muted text-truncate">Inland Trainings</p>
                    </div>
                    <div class="col-4">
                        <h5 class="mb-0">{{ count($inhouse_trained_employee) }}</h5>
                        <p class="text-muted text-truncate">Inhouse Trainings</p>
                    </div>
                </div>

                <canvas id="doughnutChart" height="250px" style="max-height: 300px;"></canvas>

            </div>
        </div>

        {{-- <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Overview</h3>

                    <canvas id="polarChartDemo" height="250px" style="max-height: 300px;"></canvas>

                </div>
            </div> --}}

        {{-- <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">Training </h3>

                    <canvas id="radarChart" height="250px" style="max-height: 300px;"></canvas>

                </div>
            </div> --}}

    </div>
    {{-- ---end-----Charts--- --}}


@endsection
@section('js')
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{ url(asset('assets/admin/js/plugins/chart.js')) }}"></script>

    <script type="text/javascript">
        {{-- ---start-----Bar Chart--- --}}
        let bar_data = {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                "November", "December"
            ],
            datasets: [{
                    label: "Promotion Last Year",
                    data: @json($promotion_group_by_month_last_year),
                    backgroundColor: [
                        'rgba(47,142,226,0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192)',
                    ],
                    borderWidth: 1,
                },
                {
                    label: "Transfer Last Year",
                    data: @json($transfer_group_by_month_last_year),
                    backgroundColor: [
                        'rgba(226,43,85,0.25)',
                    ],
                    borderColor: [
                        'rgb(196,24,24)',
                    ],
                    borderWidth: 1,
                }
            ]
        };
        let bar_options = {
            scales: {
                x: [{
                    grid: {
                        offset: true
                    },
                    ticks: {
                        max: 100,
                        min: 0,
                        stepSize: 10
                    }
                }]
            }
        };

        let ctxb = $("#barChart").get(0).getContext("2d");
        let barChart = new Chart(ctxb, {
            type: 'bar',
            data: bar_data,
            options: bar_options
        });
        {{-- ---end-----Bar Chart--- --}}

        {{-- ---start-----Pie Chart--- --}}
        let pie_data = {
            labels: [
                'Awarded Employee',
                'Achievement Employee',
            ],
            datasets: [{
                label: 'My First Dataset', // unnecessary
                data: [@json($total_awarded_employee), @json($total_achievement_employee)],
                backgroundColor: [
                    'rgba(255, 99, 132, 100)',
                    'rgba(54, 162, 235, 100)',
                    'rgba(255, 205, 86, 100)'
                ],
                hoverOffset: 4
            }]
        };

        let ctxp = $("#pieChart").get(0).getContext("2d");
        let pieChart = new Chart(ctxp, {
            type: 'pie',
            data: pie_data,
            options: bar_options
        });
        {{-- ---end-----Pie Chart--- --}}

        {{-- ---start-----Pie Chart--- --}}
        let doughnut_data = {
            labels: [
                'Foreign Trained',
                'Inland Trained',
                'Inhouse Trained',
            ],
            datasets: [{
                label: 'My First Dataset', // unnecessary
                data: [@json($total_foreign_trained_employee), @json($total_local_trained_employee),
                    @json($total_inhouse_trained_employee)
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 100)',
                    'rgba(54, 162, 235, 100)',
                    'rgba(255, 205, 86, 100)'
                ],
                hoverOffset: 4
            }]
        }

        let ctxd = $("#doughnutChart").get(0).getContext("2d");
        let doughnutChart = new Chart(ctxd, {
            type: 'doughnut',
            data: doughnut_data,
            options: bar_options
        });
        {{-- ---end-----Pie Chart--- --}}

        /*let ctxl = $("#lineChartDemo").get(0).getContext("2d");
        let lineChart = new Chart(ctxl).Line(data);*/

        /* let ctxpo = $("#polarChartDemo").get(0).getContext("2d");
         let polarChart = new Chart(ctxpo).PolarArea(pdata);*/

        let ctxr = $("#radarChart").get(0).getContext("2d");
        let radarChart = new Chart(ctxr, {
            type: 'radar',
            data: bar_data,
            options: bar_options
        });
    </script>
    <!-- Google analytics script-->
    {{-- <script type="text/javascript">
        if(document.location.hostname == 'pratikborsadiya.in') {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }
    </script> --}}
@endsection
