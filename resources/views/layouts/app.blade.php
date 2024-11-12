<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') | POPI</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <link rel="shortcut icon" href="{{ asset('storage/' . Storage::get('icon')) }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/bootstrap/css/daterangepicker.css') }}">
    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/bootstrap/css/bootstrap-datepicker.min.css') }}">
    @stack('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/datatable/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/datatable/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <style>
        .nav-tabs .nav-link {
            background-color: #f8f9fa;
            /* Light grey background for tabs */
            border: 1px solid #dee2e6;
        }

        .app-header__logo img {
            border-radius: 15px;
            padding: 5px;
        }

        .nav-tabs .nav-link.active {
            background-color: #ffffff;
            /* White background for active tab */
        }

        .tab-content {
            background-color: #ffffff;
            /* White background for tab content */
            border: 1px solid #dee2e6;
            border-top: none;
            padding: 20px;
            width: 100%;
        }

        .app-menu__item.active {
            color: #009688;
        }

        .app-menu__label:hover {
            text-transform: uppercase;
            color: #009688;
        }

        .treeview-menu .treeview-item i {
            padding-right: 5px;
        }

        #img_url {
            border: none;
        }

        input {
            text-transform: uppercase;
        }

        input#email {
            text-transform: lowercase;
        }

        textarea {
            text-transform: uppercase;
        }

        .datepicker {
            top: 232px !important;
        }

        th {
            font-size: 16px;
        }

        td {
            font-size: 14px;
        }

        .datepicker-orient-bottom {
            /* top: 380px !important; */
        }

        div.dt-button-collection.four-column {
            padding-bottom: 1px;
            -webkit-column-count: 2;
            -moz-column-count: 4;
            /*-ms-column-count: 4;*/
            /*-o-column-count: 4;*/
            /*column-count: 1;*/
            width: 1400px;
            margin-left: -700px !important;
        }

        /* new styles to be added */
        .table-full {
            width: 100%;
            border: 1px solid gray;

        }


        .table-full td {
            padding: 0.25rem;
            border: 1px solid rgb(72, 74, 73);
            text-align: center;

        }

        .table-full th {
            padding: 0.25rem;
            /* background-color: #a1efe240; */
            border: 1px solid #3d42426d;
            color: rgb(88, 87, 87);
            text-align: center;
            font-size: 1rem;
            font-weight: 100;
            background-color: #4c9a89;
            color: rgb(231, 245, 235);
            font-family: sans-serif;
        }

        .input-label {
            color: rgb(84, 85, 85);
            font-family: sans-serif;
            font-weight: bold;
            font-size: 14px;
        }

        .input-pad {
            width: 100%;
            padding: 0.25rem;
            border-radius: 6px;
            border: 1px solid rgba(156, 154, 154, 0.778);
        }

        .input-pad:focus {
            border-color: #9dc7f4;
            /* Change this to your desired border color */
            box-shadow: 0 0 5px rgba(117, 178, 244, 0.5);
            /* Optional: add a box shadow */
            outline: none;
            /* Removes the default outline */
        }

        .dataTables_wrapper .top {
            display: flex; 
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .dataTables_wrapper .top .dt-buttons {
            margin-right: auto;
        }

        .dataTables_wrapper .top .dataTables_length,
        .dataTables_wrapper .top .dataTables_filter {
            margin-right: 20px;/
        }

        .dataTables_wrapper .top .dataTables_length {
            display: flex;
            align-items: center;  
        }

        table.dataTable tbody td.select-checkbox:before, table.dataTable tbody th.select-checkbox:before {
            content: " ";
            margin-top: 0px !important;
            margin-left: 5px !important;
            border: 1px solid black;
            border-radius: 3px;
        }
    </style>

@stack('styles')
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header">
        {{--    <a class="app-header__logo" href="{{url('/')}}">FSCD HRM</a> --}}
        <a class="app-header__logo" href="{{ url('/') }}">
            <img src="{{ asset('storage/' . Storage::get('dashboard_company_logo')) }}" alt="master.page_title" height="45"></a>
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <ul class="app-nav">
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown"
                    aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>

            </li>
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown"
                    aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fa fa-user fa-lg"></i>
                            Profile</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-lg"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        @include('admin.partial.sidebar')
    </aside>
    <main class="app-content">
        @yield('content')
    </main>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('js')
    <script src="{{ url(asset('assets/admin/js/plugins/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ url(asset('assets/admin/js/plugins/dataTables.bootstrap.min.js')) }}"></script>


    <script src="{{ url(asset('assets/admin/datatable/js/dataTables.buttons.min.js')) }}"></script>
    <script src="{{ url(asset('assets/admin/datatable/js/jszip.min.js')) }}"></script>
    <script src="{{ url(asset('assets/admin/datatable/js/pdfmake.min.js')) }}"></script>
    <script src="{{ url(asset('assets/admin/datatable/js/vfs_fonts.js')) }}"></script>
    <script src="{{ url(asset('assets/admin/datatable/js/buttons.html5.min.js')) }}"></script>
    <script src="{{ url(asset('assets/admin/datatable/js/buttons.print.min.js')) }}"></script>
    <script src="{{ url(asset('assets/admin/datatable/js/buttons.colVis.min.js')) }}"></script>
    <script src="{{ url(asset('assets/admin/datatable/js/dataTables.select.min.js')) }}"></script>
    <script src="{{ url(asset('assets/admin/bootstrap/js/bootstrap.min.js')) }}"></script>

    <script type="text/javascript">
        $('#sampleTable, #secondSampleTable').DataTable({
            "dom": '<"top"f>t<"bottom"lip>',
            "dom": '<"top"lfr>t<"bottom"ip>',
            "dom": '<"top"Blfr>t<"bottom"ip>',
            responsive: true,
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                @yield('datatable-buttons') 'selectAll',
                'selectNone',
            ],
            columnDefs: [
                {
                    "targets": [],
                    "visible": false
                },
                {
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }
            ],
            select: {
                style: 'multi',
                // selector: 'td:first-child'
            },
        });
    </script>
    <script src="{{ asset('vue-js/vue/dist/vue.min.js') }}"></script>
    <script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>
    <script src="{{ url(asset('assets/admin/js/plugins/select2.min.js')) }}"></script>
    <script src="{{ url(asset('assets/admin/js/moment.min.js')) }}"></script>
    <script src="{{ url(asset('assets/admin/js/sweetalert.min.js')) }}"></script>
    <script src="{{ url(asset('assets/admin/bootstrap/js/daterangepicker.js')) }}"></script>
    <script type="text/javascript" async defer>
        // auto colon in datepicker

        var time = document.getElementsByClassName("demoDate"); //Get all elements with class "demoDate"
        for (var i = 0; i < time.length; i++) { //Loop trough elements
            time[i].addEventListener('keyup', function(e) {
                ; //Add event listener to every element
                var reg = /[0-9]/;
                if (this.value.length == 2 && reg.test(this.value)) this.value = this.value +
                    "-"; //Add colon if string length > 2 and string is a number
                if (this.value.length == 5 && reg.test(this.value)) this.value = this.value +
                    "-"; //Add colon if string length > 2 and string is a number
                // if (this.value.length ==3) this.value = this.value.substr(0, this.value.length - 1); //Delete the last digit if string length > 5
            });
        };

        var time = document.getElementsByClassName("demoDate2"); //Get all elements with class "demoDate"
        for (var i = 0; i < time.length; i++) { //Loop trough elements
            time[i].addEventListener('keyup', function(e) {
                ; //Add event listener to every element
                var reg = /[0-9]/;
                if (this.value.length == 2 && reg.test(this.value)) this.value = this.value +
                    "-"; //Add colon if string length > 2 and string is a number
                if (this.value.length == 5 && reg.test(this.value)) this.value = this.value +
                    "-"; //Add colon if string length > 2 and string is a number
                // if (this.value.length ==3) this.value = this.value.substr(0, this.value.length - 1); //Delete the last digit if string length > 5
            });
        };
        // auto colon in datepicker

        $('#sl').on('click', function() {
            $('#tl').loadingBtn();
            $('#tb').loadingBtn({
                text: "Signing In"
            });
        });

        $('#el').on('click', function() {
            $('#tl').loadingBtnComplete();
            $('#tb').loadingBtnComplete({
                html: "Sign In"
            });
        });
        // datepicker
        $('.demoDate, .demoDate2, .demoDate3').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom right"
        });

        function matchStart(params, data) {
            params.term = params.term || '';
            if (data.text.toUpperCase().indexOf(params.term.toUpperCase()) === 0) {
                return data;
            }
            return false;
        }

        // $(".demoSelect").select2({
        //     matcher: function(params, data) {
        //         return matchStart(params, data);
        //     },
        // });

        $(document).ready(function() {
            //upercase input field
            $('input[type="text"]').focusout(function() {
                // Uppercase-ize contents
                this.value = this.value.toLocaleUpperCase();
                email_lowercase()

            });
            $('textarea').focusout(function() {
                // Uppercase-ize contents
                this.value = this.value.toUpperCase();
            });

            function email_lowercase() {
                $('#email').each(function() {
                    this.value = this.value.toLowerCase();
                });

            }
        });
    </script>

    {!! Toastr::message() !!}
    <!-- Google analytics script-->
    <script type="text/javascript">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error', {
                    closeButton: true,
                    progressBar: true,
                });
            @endforeach
        @endif
        if (document.location.hostname === 'pratikborsadiya.in') {
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }
    </script>
    <script>
        $('.delete-confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete ${name}?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>

    @if (strtolower(config('app.env')) == 'production' || strtolower(config('app.env')) == 'development')
        @php
            //Detect special conditions devices
            $iPod = stripos($_SERVER['HTTP_USER_AGENT'], 'iPod');
            $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
            $iPad = stripos($_SERVER['HTTP_USER_AGENT'], 'iPad');
            $Android = stripos($_SERVER['HTTP_USER_AGENT'], 'Android');
            $webOS = stripos($_SERVER['HTTP_USER_AGENT'], 'webOS');
            //add for mac OS
            $Macintosh = stripos($_SERVER['HTTP_USER_AGENT'], 'Macintosh');
            $MacOS = stripos($_SERVER['HTTP_USER_AGENT'], 'MacOS');
        @endphp
        {{-- do something with this information --}}
        @if ($iPad || $iPod || $iPhone || $webOS || $Macintosh || $MacOS)
            {{-- for iOS devices, screen becomes blank for disabling inspection --}}
        @else
            @include('layouts.disable_inspections_script')
        @endif
    @endif

    <!-- Bootstrap Datepicker JS -->
    <script src="{{ url(asset('assets/admin/bootstrap/js/bootstrap-datepicker.min.js')) }}"></script>
    <script>
        $(document).ready(function() {
            $('#datepicker').datepicker({
                format: 'mm/yyyy', // Format as needed
                minViewMode: 1,
                autoclose: true,
                todayHighlight: true
            });
            // for global select2
            $('.select2').select2({
                width: 'resolve' // Adjust width to match the parent element
            });
        });
    </script>

    @stack('script')
</body>

</html>
