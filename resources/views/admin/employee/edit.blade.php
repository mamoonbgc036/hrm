@extends('layouts.app')
@section('title', 'Edit Employee')
@push('css')
    <style>
        label {
            font-size: 1em !important;
        }
    </style>
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user-plus text-info" aria-hidden="true"></i> Employee</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <div class="inner-btn-wrap">
                                <button id="basic_info" class="btn btn-sm btn-info active">Basic Info <span class="text-warning font-bold"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
                                <button id="workStation" class="btn btn-sm btn-info">Working Station <span class="text-warning font-bold"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
                                <button id="address_info" class="btn btn-sm btn-info">Address <span class="text-warning font-bold"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
                                <button id="education_info" class="btn btn-sm btn-info">Education <span class="text-warning font-bold"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
                                <button id="experience_information" class="btn btn-sm btn-info">Experience <span class="text-warning font-bold"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
                                <button id="family_info" class="btn btn-sm btn-info">Family & Other Info <span class="text-warning font-bold"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
                                <button id="other_info" class="btn btn-sm btn-info">Other Information <span class="text-warning font-bold"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
                                <button id="nominee_info" class="btn btn-sm btn-info">Nominee <span class="text-warning font-bold"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
                                <button id="emergency_contact" class="btn btn-sm btn-info">Emergency Contact <span class="text-warning font-bold"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
                                <button id="training_info" class="btn btn-sm btn-info">Training Information <span class="text-warning font-bold"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
                                <button id="disease_info" class="btn btn-sm btn-info">Disease Information <span class="text-warning font-bold"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid p-0" id="showBasic">
                        <div class="from-section-wrap">
                            <h3 class="from-heading"><i class="fa fa-pencil-square text-white" aria-hidden="true"></i> Basic Info</h3>
                            <div class="from-field-wrap p-2">
                                @include('admin.employee.layout.edit.basic_info')
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid p-0" id="showWorkStation">
                        <div class="from-section-wrap">
                            <h3 class="from-heading"><i class="fa fa-pencil-square text-white" aria-hidden="true"></i> Working Station</h3>
                            <div class="from-field-wrap p-2">
                                <form id="work_station_form" method="post">
                                    @csrf
                                    @include('admin.employee.layout.edit.workStation')
                                    <div class="row">
                                        @if (Session::has('employee_id'))
                                            <input type="hidden" name="id" value="{{ Session::get('employee_id') }}">
                                        @else
                                        @endif
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success btn-sm">Next</button>
                                        </div>
        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid p-0" id="showAddress">
                        <div class="from-section-wrap">
                            <h3 class="from-heading"><i class="fa fa-pencil-square text-white" aria-hidden="true"></i> Address Info</h3>
                            <div class="from-field-wrap p-2">
                                <form id="address_form" method="post">
                                    @csrf
                                    @if (Session::has('employee_id'))
                                        <input type="hidden" name="id" value="{{ Session::get('employee_id') }}">
                                    @else
                                    @endif
                                    @include('admin.employee.layout.edit.address')
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success btn-sm">next</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid p-0" id="showEducation">
                        <div class="from-section-wrap">
                            <h3 class="from-heading"><i class="fa fa-pencil-square text-white" aria-hidden="true"></i> Education Info</h3>
                            <div class="from-field-wrap p-2">
                                @include('admin.employee.layout.edit.education')
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid p-0" id="showExperience">
                        <div class="from-section-wrap">
                            <h3 class="from-heading"><i class="fa fa-pencil-square text-white" aria-hidden="true"></i> Experience Info</h3>
                            <div class="from-field-wrap p-2">
                                @include('admin.employee.layout.edit.experience')
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('experience.job.position') }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Job Position</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="name">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid p-0" id="showFamily">
                        <div class="from-section-wrap">
                            <h3 class="from-heading"><i class="fa fa-pencil-square text-white" aria-hidden="true"></i> Family & Others</h3>
                            <div class="from-field-wrap p-2">
                                @include('admin.employee.layout.edit.family')
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid p-0" id="showJournal">
                        <div class="from-section-wrap">
                            <h3 class="from-heading"><i class="fa fa-pencil-square text-white" aria-hidden="true"></i> Others Information</h3>
                            <div class="from-field-wrap p-2">
                                @include('admin.employee.layout.edit.journal')
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid p-0" id="showNominee">
                        <div class="from-section-wrap">
                            <h3 class="from-heading"><i class="fa fa-pencil-square text-white" aria-hidden="true"></i> Nominee Info.</h3>
                            <div class="from-field-wrap p-2">
                                @include('admin.employee.layout.edit.nominee')
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid p-0" id="emergency_info">
                        <div class="from-section-wrap">
                            <h3 class="from-heading"><i class="fa fa-pencil-square text-white" aria-hidden="true"></i> Emergency Contact</h3>
                            <div class="from-field-wrap p-2">
                                @include('admin.employee.layout.edit.emergency')
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid p-0" id="showTraining">
                        <div class="from-section-wrap">
                            <h3 class="from-heading"><i class="fa fa-pencil-square text-white" aria-hidden="true"></i> Training Information</h3>
                            <div class="from-field-wrap p-2">
                                @include('admin.employee.layout.edit.training')
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid p-0" id="showDisease">
                        <div class="from-section-wrap">
                            <h3 class="from-heading"><i class="fa fa-pencil-square text-white" aria-hidden="true"></i> Disease Information</h3>
                            <div class="from-field-wrap p-2">
                                @include('admin.employee.layout.edit.disease')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    @include('admin.employee.script.script')
    <script>
        $(document).ready(function(){
            var menuItems = document.querySelectorAll('.inner-btn-wrap .btn-info');
            //Add a click event listener to each menu item
            menuItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    menuItems.forEach(function(item) {
                        item.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
        })

        const elementIds = [
            "showBasic",
            "showWorkStation",
            "showAddress",
            "showEducation",
            "showExperience",
            "showFamily",
            "showJournal",
            "showNominee",
            "emergency_info",
            "showTraining",
            "showDisease"
        ];

        function getNone() {
            // Array containing the IDs of the elements to hide


            // Loop through the array and hide each element
            for (let i = 0; i < elementIds.length; i++) {
                const element = document.getElementById(elementIds[i]);
                if (element) { // Check if the element exists to avoid errors
                    element.style.display = "none";
                }
            }

        }
    </script>
    <script>
        getNone();
        document.getElementById("showBasic").style.display = "block";
        function hideElements(parameter) {
            const toBlock = document.getElementById(parameter);
            for (let i = 0; i < elementIds.length; i++) {
                const element = document.getElementById(elementIds[i]);
                if (elementIds[i] == parameter) {
                    if (element) {
                        element.style.display = "block";
                    }
                } else {
                    element.style.display = "none";
                }

            }
        }

        $('.skip_experience').click(function(e) {
            hideElements("showFamily");
        })


        document.getElementById('basic_info').onclick = function() {

            hideElements("showBasic");
        };

        document.getElementById('workStation').onclick = function() {

            hideElements("showWorkStation");
        };
        document.getElementById('address_info').onclick = function() {

            hideElements("showAddress");
        };
        document.getElementById('education_info').onclick = function() {

            hideElements("showEducation");
        };
        document.getElementById('experience_information').onclick = function() {

            hideElements("showExperience");
        };
        document.getElementById('family_info').onclick = function() {
            hideElements("showFamily");
        };
        document.getElementById('other_info').onclick = function() {
            hideElements("showJournal");
        };
        document.getElementById('nominee_info').onclick = function() {
            hideElements("showNominee");
        };
        document.getElementById('emergency_contact').onclick = function() {

            hideElements("emergency_info");
        };
        document.getElementById('training_info').onclick = function() {

            hideElements("showTraining");
        };
        document.getElementById('disease_info').onclick = function() {

            hideElements("showDisease");
        };
    </script>
    <script>
        document.getElementById('img_url').addEventListener('change', function() {
            const fileInput = document.getElementById('img_url');
            const file = fileInput.files[0]; // Get the first file

            if (file) {
                console.log('File name:', file.name);
                console.log('File type:', file.type);
                console.log('File size:', file.size);
                console.log('File last modified date:', file.lastModifiedDate);
            } else {
                console.log('No file selected');
            }
        });

        function formSubmit(formId, route, buttonId) {
            const form = document.getElementById(formId);
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(form);
                $.ajax({
                    url: route,
                    type: 'POST',
                    data: formData,
                    processData: false, // Do not process the FormData object
                    contentType: false,
                    success: function(response) {
                        // console.log(response, 'test420');
                        document.getElementById(buttonId).click();
                    },
                    error: function(response) {
                        console.log(response.responseJSON.errors); // Log error response

                        if (response.responseJSON && response.responseJSON.errors.pin_no) {
                            $('#pin').text(response.responseJSON.errors.pin_no[0]);
                        }
                        if (response.responseJSON && response.responseJSON.errors
                            .birth_certificate_no) {
                            $('#birth').text(response.responseJSON.errors.birth_certificate_no[0]);
                        }
                        if (response.responseJSON && response.responseJSON.errors.nid_no) {
                            $('#nid').text(response.responseJSON.errors.nid_no[0]);
                        }
                        if (response.responseJSON && response.responseJSON.errors.mobile_no) {
                            $('#mobile').text(response.responseJSON.errors.mobile_no[0]);
                        }
                        if (response.responseJSON && response.responseJSON.errors.email) {
                            $('#mail').text(response.responseJSON.errors.email[0]);
                        }
                    }
                });
            });
        }
        formSubmit('BasicInfo', '{{ route('employee-update-basic') }}', 'workStation');
        formSubmit('work_station_form', '{{ route('employee-work-station') }}', 'address_info');
        formSubmit('address_form', '{{ route('employee-address') }}', 'education_info');
        formSubmit('educationInfoForm', '{{ route('employee-education') }}', 'experience_information');
        formSubmit('experience_info_form', '{{ route('employee-experience') }}', 'family_info');
        formSubmit('family_info_form', '{{ route('employee-family') }}', 'other_info');
        formSubmit('journalInformationForm', '{{ route('employee-journal') }}', 'nominee_info');
        formSubmit('nomineeInfoForm', '{{ route('employee-nominee') }}', 'emergency_contact');
        formSubmit('contactInfoForm', '{{ route('employee-emergency') }}', 'training_info');
        formSubmit('trainingInformation', '{{ route('employee-training') }}', 'disease_info');
    </script>
    {{-- select2 --}}
    <!-- Include Select2 CSS -->


    <!-- Include jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 on the select element
            $('#multi_select').select2({
                placeholder: "Select options",
                allowClear: true, // Allows users to clear selections
                width: '100%' // Ensures full width usage of select element
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '.my_district_id', function() {
                let district_id = $(this).val();
                let url = "{{ route('fetch-thana', ':district_id') }}".replace(':district_id',
                    district_id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        let opt =
                            '<option value="" disabled selected hidden>Select Branch</option>';
                        $('.sub_location_id').empty();
                        $.each(data, function(index, item) {
                            opt += `<option value="${item.id}">${item.name}
                                            </option>`;
                        });
                        $('#sub_location_id').append(opt);
                    }
                })
            })
        });
    </script>

    {{-- // --}}
@endpush
