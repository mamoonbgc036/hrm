@extends('layouts.app')
@section('title','Search Employee')
@push('css')

    <style>
        label {
            font-size: 1em !important;
        }

        .demoSelect {
            width: 100% !important;
        }

    </style>
@endpush
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Employee</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row" id="vue_app">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5">Employee Export Dynamically</span>
                </div>
                <div class="card-body">

                    @include('admin.employee.search-criteria-data-for-export')

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection

@push('script')
    <script>


        /*$(document).on('click', '#export', function () {
            event.preventDefault();

            let formData = new FormData(document.getElementById("form"));

            $.ajaxSetup({
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
            });

            $.ajax({
                url: '/employees/dynamic-export/',
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,

                success: function (response) {
                    // window.location.href = response.url;
                },
                error: function (xhr) {
                    console.log(xhr)
                }
            });
        });*/

        $(document).ready(function () {
            let vm = new Vue({
                el: '#vue_app',
                data: {
                    selectedColumn: '',
                    insertedColumn: [],
                    inputData: '<label class="col-form-label col-form-label-sm" for="m_name">' + this.selectedColumn + '</label>',
                    gpf_no: '{{request('gpf_no')?true:false}}',
                    religion: '{{request('religion')?true:false}}',
                    quota: '{{request('quota')?true:false}}',
                    nid_no: '{{request('nid_no')?true:false}}',
                    pin_no: '{{request('pin_no')?true:false}}',
                    new_pin: '{{request('new_pin')?true:false}}',
                    f_name: '{{request('f_name')?true:false}}',
                    m_name: '{{request('m_name')?true:false}}',

                    designation_id: '{{request('designation_id')?true:false}}',
                    grade_id: '{{request('grade_id')?true:false}}',
                    station_name: '{{request('station_name')?true:false}}',
                    station_mobile: '{{request('station_mobile')?true:false}}',
                    station_division: '{{request('station_division')?true:false}}',
                    station_district: '{{request('station_district')?true:false}}',
                    station_thana: '{{request('station_thana')?true:false}}',
                    is_attached: '{{request('is_attached')?true:false}}',
                    attached_designation_id: '{{request('attached_designation_id')?true:false}}',
                    attached_station_name: '{{request('attached_station_name')?true:false}}',
                    attached_station_division: '{{request('attached_station_division')?true:false}}',
                    attached_station_district: '{{request('attached_station_district')?true:false}}',
                    attached_station_thana: '{{request('attached_station_thana')?true:false}}',

                    blood_group: '{{request('blood_group')?true:false}}',
                    gender: '{{request('gender')?true:false}}',
                    passport_no: '{{request('passport_no')?true:false}}',
                    marital_status: '{{request('marital_status')?true:false}}',
                    id_card_no: '{{request('id_card_no')?true:false}}',
                    welfare_no: '{{request('welfare_no')?true:false}}',
                    womens_welfare_no: '{{request('womens_welfare_no')?true:false}}',
                    e_tin_no: '{{request('e_tin_no')?true:false}}',
                    birth_district: '{{request('birth_district')?true:false}}',
                    disability_code: '{{request('disability_code')?true:false}}',
                    age: '{{request('age')?true:false}}',
                    birth_date: '{{request('birth_date')?true:false}}',
                    join_date: '{{request('join_date')?true:false}}',
                    lpr_date: '{{request('lpr_date')?true:false}}',

                    spouse_name: '{{request('spouse_name')?true:false}}',
                    spouse_tin: '{{request('spouse_tin')?true:false}}',
                    spouse_profession: '{{request('spouse_profession')?true:false}}',
                    spouse_district: '{{request('spouse_district')?true:false}}',
                    spouse_child: '{{request('spouse_child')?true:false}}',

                    home_contact: '{{request('home_contact')?true:false}}',
                    email: '{{request('email')?true:false}}',
                    emergency_person_name: '{{request('emergency_person_name')?true:false}}',
                    emergency_person_number: '{{request('emergency_person_number')?true:false}}',
                    emergency_person_relation: '{{request('emergency_person_relation')?true:false}}',

                    present_division: '{{request('present_division')?true:false}}',
                    present_district: '{{request('present_district')?true:false}}',
                    present_thana: '{{request('present_thana')?true:false}}',
                    present_post_office: '{{request('present_post_office')?true:false}}',
                    present_postal_code: '{{request('present_postal_code')?true:false}}',
                    present_village: '{{request('present_village')?true:false}}',
                    present_uccw: '{{request('present_uccw')?true:false}}',
                    present_house_no: '{{request('present_house_no')?true:false}}',

                    permanent_division: '{{request('permanent_division')?true:false}}',
                    permanent_district: '{{request('permanent_district')?true:false}}',
                    permanent_thana: '{{request('permanent_thana')?true:false}}',
                    permanent_post_office: '{{request('permanent_post_office')?true:false}}',
                    permanent_postal_code: '{{request('permanent_postal_code')?true:false}}',
                    permanent_village: '{{request('permanent_village')?true:false}}',
                    permanent_uccw: '{{request('permanent_uccw')?true:false}}',
                    permanent_house_no: '{{request('permanent_house_no')?true:false}}',

                    award: '{{request('award')?true:false}}',
                    achievement: '{{request('achievement')?true:false}}',
                    foreign_training: '{{request('foreign_training')?true:false}}',
                    local_training: '{{request('local_training')?true:false}}',
                    inhouse_training: '{{request('inhouse_training')?true:false}}',
                    punishment: '{{request('punishment')?true:false}}',
                    leave: '{{request('leave')?true:false}}',

                    jsc_examination: '{{request('jsc_examination')?true:false}}',
                    jsc_board: '{{request('jsc_board')?true:false}}',
                    jsc_roll: '{{request('jsc_roll')?true:false}}',
                    jsc_result: '{{request('jsc_result')?true:false}}',
                    jsc_institute: '{{request('jsc_institute')?true:false}}',
                    jsc_passing_year: '{{request('jsc_passing_year')?true:false}}',

                    ssc_examination: '{{request('ssc_examination')?true:false}}',
                    ssc_board: '{{request('ssc_board')?true:false}}',
                    ssc_roll: '{{request('ssc_roll')?true:false}}',
                    ssc_result: '{{request('ssc_result')?true:false}}',
                    ssc_institute: '{{request('ssc_institute')?true:false}}',
                    ssc_passing_year: '{{request('ssc_passing_year')?true:false}}',
                    ssc_subject: '{{request('ssc_subject')?true:false}}',

                    hsc_examination: '{{request('hsc_examination')?true:false}}',
                    hsc_board: '{{request('hsc_board')?true:false}}',
                    hsc_roll: '{{request('hsc_roll')?true:false}}',
                    hsc_result: '{{request('hsc_result')?true:false}}',
                    hsc_institute: '{{request('hsc_institute')?true:false}}',
                    hsc_passing_year: '{{request('hsc_passing_year')?true:false}}',
                    hsc_subject: '{{request('hsc_subject')?true:false}}',

                    graduation_examination: '{{request('graduation_examination')?true:false}}',
                    graduation_duration: '{{request('graduation_duration')?true:false}}',
                    graduation_result: '{{request('graduation_result')?true:false}}',
                    graduation_institute: '{{request('graduation_institute')?true:false}}',
                    graduation_passing_year: '{{request('graduation_passing_year')?true:false}}',
                    graduation_subject: '{{request('graduation_subject')?true:false}}',

                    masters_examination: '{{request('masters_examination')?true:false}}',
                    masters_duration: '{{request('masters_duration')?true:false}}',
                    masters_result: '{{request('masters_result')?true:false}}',
                    masters_institute: '{{request('masters_institute')?true:false}}',
                    masters_passing_year: '{{request('masters_passing_year')?true:false}}',
                    masters_subject: '{{request('masters_subject')?true:false}}',

                    professional_designation: '{{request('professional_designation')?true:false}}',
                    professional_organization: '{{request('professional_organization')?true:false}}',
                    professional_from_date: '{{request('professional_from_date')?true:false}}',
                    professional_to_date: '{{request('professional_to_date')?true:false}}',
                    professional_responsibilities: '{{request('professional_responsibilities')?true:false}}',

                },
                methods: {
                    insertNewInputField() {
                        let column = vm.selectedColumn;
                        switch (column) {
                            case 'religion':
                                vm.religion = true;
                                break;
                            case 'quota':
                                vm.quota = true;
                                break;
                            case 'nid_no':
                                vm.nid_no = true;
                                break;
                            case 'gpf_no':
                                vm.gpf_no = true;
                                break;
                            case 'pin_no':
                                vm.pin_no = true;
                                break;
                            case 'new_pin':
                                vm.new_pin = true;
                                break;

                            {{-------JOB HISTORY-------start-------}}
                            case 'designation':
                                vm.designation_id = true;
                                break;
                            case 'grade':
                                vm.grade_id = true;
                                break;
                            case 'station_name':
                                vm.station_name = true;
                                break;
                            case 'station_mobile':
                                vm.station_mobile = true;
                                break;
                            case 'station_division':
                                vm.station_division = true;
                                break;
                            case 'station_district':
                                vm.station_district = true;
                                break;
                            case 'station_thana':
                                vm.station_thana = true;
                                break;
                            case 'is_attached':
                                vm.is_attached = true;
                                break;
                            case 'attached_designation_id':
                                vm.attached_designation_id = true;
                                break;
                            case 'attached_station_name':
                                vm.attached_station_name = true;
                                break;
                            case 'attached_station_division':
                                vm.attached_station_division = true;
                                break;
                            case 'attached_station_district':
                                vm.attached_station_district = true;
                                break;
                            case 'attached_station_thana':
                                vm.attached_station_thana = true;
                                break;

                            case 'blood_group':
                                vm.blood_group = true;
                                break;
                            case 'gender':
                                vm.gender = true;
                                break;
                            case 'passport_no':
                                vm.passport_no = true;
                                break;
                            case 'f_name':
                                vm.f_name = true;
                                break;
                            case 'm_name':
                                vm.m_name = true;
                                break;
                            case 'marital_status':
                                vm.marital_status = true;
                                break;
                            case 'id_card_no':
                                vm.id_card_no = true;
                                break;
                            case 'welfare_no':
                                vm.welfare_no = true;
                                break;
                            case 'womens_welfare_no':
                                vm.womens_welfare_no = true;
                                break;
                            case 'e_tin_no':
                                vm.e_tin_no = true;
                                break;
                            case 'birth_district':
                                vm.birth_district = true;
                                break;
                            case 'disability_code':
                                vm.disability_code = true;
                                break;
                            case 'age':
                                vm.age = true;
                                break;
                            case 'birth_date':
                                vm.birth_date = true;
                                break;
                            case 'join_date':
                                vm.join_date = true;
                                break;
                            case 'lpr_date':
                                vm.lpr_date = true;
                                break;

                            {{-------SPOUSES-------start-------}}
                            case 'spouse_name':
                                vm.spouse_name = true;
                                break;
                            case 'spouse_tin':
                                vm.spouse_tin = true;
                                break;
                            case 'spouse_profession':
                                vm.spouse_profession = true;
                                break;
                            case 'spouse_district':
                                vm.spouse_district = true;
                                break;
                            case 'spouse_child':
                                vm.spouse_child = true;
                                break;
                            {{-------SPOUSES-------end-------}}

                            case 'home_contact':
                                vm.home_contact = true;
                                break;
                            case 'email':
                                vm.email = true;
                                break;
                            case 'emergency_person_name':
                                vm.emergency_person_name = true;
                                break;
                            case 'emergency_person_number':
                                vm.emergency_person_number = true;
                                break;
                            case 'emergency_person_relation':
                                vm.emergency_person_relation = true;
                                break;

                            {{-------Present Address-------start-------}}
                            case 'present_division':
                                vm.present_division = true;
                                break;
                            case 'present_district':
                                vm.present_district = true;
                                break;
                            case 'present_thana':
                                vm.present_thana = true;
                                break;
                            case 'present_post_office':
                                vm.present_post_office = true;
                                break;
                            case 'present_postal_code':
                                vm.present_postal_code = true;
                                break;
                            case 'present_village':
                                vm.present_village = true;
                                break;
                            case 'present_uccw':
                                vm.present_uccw = true;
                                break;
                            case 'present_house_no':
                                vm.present_house_no = true;
                                break;
                            {{-------Present Address-------end-------}}

                            {{-------Permanent Address-------start-------}}
                            case 'permanent_division':
                                vm.permanent_division = true;
                                break;
                            case 'permanent_district':
                                vm.permanent_district = true;
                                break;
                            case 'permanent_thana':
                                vm.permanent_thana = true;
                                break;
                            case 'permanent_post_office':
                                vm.permanent_post_office = true;
                                break;
                            case 'permanent_postal_code':
                                vm.permanent_postal_code = true;
                                break;
                            case 'permanent_village':
                                vm.permanent_village = true;
                                break;
                            case 'permanent_uccw':
                                vm.permanent_uccw = true;
                                break;
                            case 'permanent_house_no':
                                vm.permanent_house_no = true;
                                break;
                            {{-------Permanent Address-------end-------}}

                            {{-------Operations-------start-------}}
                            case 'award':
                                vm.award = true;
                                break;
                            case 'achievement':
                                vm.achievement = true;
                                break;
                            case 'foreign_training':
                                vm.foreign_training = true;
                                break;
                            case 'local_training':
                                vm.local_training = true;
                                break;
                            case 'inhouse_training':
                                vm.inhouse_training = true;
                                break;
                            case 'punishment':
                                vm.punishment = true;
                                break;
                            case 'leave':
                                vm.leave = true;
                                break;
                            {{-------Operations-------end-------}}

                            {{-------JSC-------start-------}}
                            case 'jsc_examination':
                                vm.jsc_examination = true;
                                break;
                            case 'jsc_board':
                                vm.jsc_board = true;
                                break;
                            case 'jsc_roll':
                                vm.jsc_roll = true;
                                break;
                            case 'jsc_result':
                                vm.jsc_result = true;
                                break;
                            case 'jsc_institute':
                                vm.jsc_institute = true;
                                break;
                            case 'jsc_passing_year':
                                vm.jsc_passing_year = true;
                                break;
                            {{-------JSC-------end-------}}

                            {{-------SSC-------start-------}}
                            case 'ssc_examination':
                                vm.ssc_examination = true;
                                break;
                            case 'ssc_board':
                                vm.ssc_board = true;
                                break;
                            case 'ssc_roll':
                                vm.ssc_roll = true;
                                break;
                            case 'ssc_result':
                                vm.ssc_result = true;
                                break;
                            case 'ssc_institute':
                                vm.ssc_institute = true;
                                break;
                            case 'ssc_passing_year':
                                vm.ssc_passing_year = true;
                                break;
                            case 'ssc_subject':
                                vm.ssc_subject = true;
                                break;
                            {{-------SSC-------end-------}}

                            {{-------HSC-------start-------}}
                            case 'hsc_examination':
                                vm.hsc_examination = true;
                                break;
                            case 'hsc_board':
                                vm.hsc_board = true;
                                break;
                            case 'hsc_roll':
                                vm.hsc_roll = true;
                                break;
                            case 'hsc_result':
                                vm.hsc_result = true;
                                break;
                            case 'hsc_institute':
                                vm.hsc_institute = true;
                                break;
                            case 'hsc_passing_year':
                                vm.hsc_passing_year = true;
                                break;
                            case 'hsc_subject':
                                vm.hsc_subject = true;
                                break;
                            {{-------HSC-------end-------}}

                            {{-------Graduation-------start-------}}
                            case 'graduation_examination':
                                vm.graduation_examination = true;
                                break;
                            case 'graduation_duration':
                                vm.graduation_duration = true;
                                break;
                            case 'graduation_result':
                                vm.graduation_result = true;
                                break;
                            case 'graduation_institute':
                                vm.graduation_institute = true;
                                break;
                            case 'graduation_passing_year':
                                vm.graduation_passing_year = true;
                                break;
                            case 'graduation_subject':
                                vm.graduation_subject = true;
                                break;
                            {{-------Graduation-------end-------}}

                            {{-------Masters-------start-------}}
                            case 'masters_examination':
                                vm.masters_examination = true;
                                break;
                            case 'masters_duration':
                                vm.masters_duration = true;
                                break;
                            case 'masters_result':
                                vm.masters_result = true;
                                break;
                            case 'masters_institute':
                                vm.masters_institute = true;
                                break;
                            case 'masters_passing_year':
                                vm.masters_passing_year = true;
                                break;
                            case 'masters_subject':
                                vm.masters_subject = true;
                                break;
                            {{-------Masters-------end-------}}

                            {{-------Professional-------start-------}}
                            case 'professional_designation':
                                vm.professional_designation = true;
                                break;
                            case 'professional_organization':
                                vm.professional_organization = true;
                                break;
                            case 'professional_from_date':
                                vm.professional_from_date = true;
                                break;
                            case 'professional_to_date':
                                vm.professional_to_date = true;
                                break;
                            case 'professional_responsibilities':
                                vm.professional_responsibilities = true;
                                break;
                                {{-------Professional-------end-------}}

                        }
                    },
                    close(element) {
                        this[element] = false
                    },
                },
                watch: {},
                mounted: {},
                updated: {},
            });

                    {{-------fetch duration of dates-------start-------}}

            let birth_date = moment($('#dob').html(), 'DD-MM-YYYY');
            let to_date = moment();

            if (birth_date.isValid() && to_date.isValid()) {
                $('#age').text(calculate_difference(birth_date,to_date));
            } else {
                console.log('AGE: Invalid date(s).')
            }

            function calculate_difference(from, to){

                let output='';
                let duration = moment.duration(to.diff(from));
                if (duration.years() === 0 && duration.months() === 0){
                    output = duration.days() +' days';
                }else if(duration.years() === 0 && duration.months() !== 0){
                    output = duration.months() + ' months ' + duration.days() +' days';
                }else{
                    output = duration.years() + ' years ' + duration.months() + ' months ' + duration.days()+' days';
                }
                console.log('from: '+from+' to: '+to+' output: '+output);
                return output;
            }

            {{-------fetch duration of dates-------end-------}}

            $('.demoSelect3').on("change", function () {
                vm.selectedColumn = $(this).val();
                vm.insertNewInputField();
            });

            $('.demoDate2').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
                todayHighlight: true,
                orientation: "bottom auto"
            });

            // datatable();

            $('#sampleTable2').DataTable({
                serverSide: true,
                processing: true,
                lengthMenu: [[10, 25, 100, 200, 500], [10, 25, 100, 200, 500]],
                ajax: {
                    "url": '{{ route('employee.search') }}',
                    "data": function(d){
                        $.each($('#form').serializeArray(), function(i, obj){
                            d['form_'+obj['name']] = obj['value'];
                        });
                    },
                },
                type: 'POST',
                columns: [
                    {data: "DT_RowIndex", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "name", name: 'name', defaultContent: ''},
                    {data: "f_name", name: 'f_name', defaultContent: ''},
                    {data: "m_name", name: 'm_name', defaultContent: ''},
                    {data: "pin_no", name: 'pin_no', defaultContent: ''},
                    {data: "new_pin", name: 'new_pin', defaultContent: ''},
                    {data: "religion", name: 'religion', defaultContent: ''},
                    {data: "blood_group", name: 'blood_group', defaultContent: ''},
                    {data: "batch_no", name: 'batch_no', defaultContent: ''},
                    {data: "id_card_no", name: 'id_card_no', defaultContent: ''},
                    {data: "gpf_no", name: 'gpf_no', defaultContent: ''},
                    {data: "welfare_no", name: 'welfare_no', defaultContent: ''},
                    {data: "womens_welfare_no", name: 'womens_welfare_no', defaultContent: ''},
                    {data: "passport_no", name: 'passport_no', defaultContent: ''},
                    {data: "nid_no", name: 'nid_no', defaultContent: ''},
                    {data: "gender", name: 'gender', defaultContent: ''},
                    {data: "dob", name: 'dob', defaultContent: ''},
                    {data: "join_date", name: 'join_date', defaultContent: ''},
                    {data: "lpr_date", name: 'lpr_date', defaultContent: ''},
                    {data: "age", name: 'age', defaultContent: ''},
                    {data: "birth_country", name: 'birth_country', defaultContent: ''},
                    {data: "birth_district", name: 'birth_district', defaultContent: ''},
                    {data: "nationality", name: 'nationality', defaultContent: ''},
                    {data: "disability_code", name: 'disability_code', defaultContent: ''},
                    {data: "e_tin_no", name: 'e_tin_no', defaultContent: ''},
                    {data: "quota", name: 'quota', defaultContent: ''},
                    {data: "marital_status", name: 'marital_status', defaultContent: ''},
                    {data: "height", name: 'height', defaultContent: ''},
                    {data: "weight", name: 'weight', defaultContent: ''},
                    {data: "identification", name: 'identification', defaultContent: ''},
                    {data: "mobile_no", name: 'mobile_no', defaultContent: ''},
                    {data: "home_contact_number", name: 'home_contact_number', defaultContent: ''},
                    {data: "email", name: 'email', defaultContent: ''},
                    {data: "e_contact_person_name", name: 'e_contact_person_name', defaultContent: ''},
                    {data: "e_contact_person_number", name: 'e_contact_person_number', defaultContent: ''},
                    {data: "e_contact_person_relation", name: 'e_contact_person_relation', defaultContent: ''},
                    {data: "presentAddress", name: 'presentAddress'},
                    {data: "permanentAddress", name: 'permanentAddress'},

                    {data: "grade", name: 'grade', defaultContent: ''},

                    {data: "job_details", name: 'job_details', defaultContent: ''},
                    /*{data: "designation.en_name", name: 'designation.en_name', defaultContent: ''},
                    {data: "jobStation.name", name: 'jobStation.name', defaultContent: ''},
                    {data: "jobDivision.name", name: 'jobDivision.name', defaultContent: ''},
                    {data: "jobDistrict.name", name: 'jobDistrict.name', defaultContent: ''},
                    {data: "jobUpazila.name", name: 'jobUpazila.name', defaultContent: ''},*/

                    {data: "is_attached_to_station_or_office", name: 'is_attached_to_station_or_office', defaultContent: ''},

                    {data: "attached_job_details", name: 'attached_job_details', defaultContent: ''},
                    /*{data: "attachedDesignation.en_name", name: 'attachedDesignation.en_name', defaultContent: ''},
                    {data: "attachedStation.name", name: 'attachedStation.name', defaultContent: ''},
                    {data: "attachedDivision.name", name: 'attachedDivision.name', defaultContent: ''},
                    {data: "attachedDistrict.name", name: 'attachedDistrict.name', defaultContent: ''},
                    {data: "attachedUpazila.name", name: 'attachedUpazila.name', defaultContent: ''},*/

                    {data: "JSC", name: 'JSC', defaultContent: ''},
                    {data: "SSC", name: 'SSC', defaultContent: ''},
                    {data: "HSC", name: 'HSC', defaultContent: ''},
                    {data: "Graduation", name: 'Graduation', defaultContent: ''},
                    {data: "Masters", name: 'Masters', defaultContent: ''},

                    {data: "action", searchable: false, orderable: false},
                ],
                "dom": 'C<"clear"><"row"B><"top d-flex justify-content-between"lipf>t<"bottom d-flex justify-content-between"lipf>',
                responsive: true,
                // stateSave: true,
                cache: true,
                buttons: [
                    {
                        extend: 'colvis',
                        collectionLayout: 'fixed four-column',
                        postfixButtons: ['colvisRestore']
                    },
                    /*{
                        extend: 'colvisGroup',
                        text: 'Office info',
                        show: [ 1, 2 ],
                        hide: [ 3, 4, 5 ]
                    },
                    {
                        extend: 'colvisGroup',
                        text: 'HR info',
                        show: [ 3, 4, 5 ],
                        hide: [ 1, 2 ]
                    },*/
                    {
                        extend: 'colvisGroup',
                        text: 'Show all',
                        show: ':hidden'
                    },

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
                        extend: 'print',
                        text: 'PRINT ALL',
                        titleAttr: 'Print ALL',
                        action: function(e, dt, button, config) {
                            dt.one('preXhr', function(e, s, data) {
                                data.start = 0;
                                data.length = -1;
                            }).one('draw', function(e, settings, json, xhr) {
                                var printButtonConfig = $.fn.dataTable.ext.buttons.print;
                                var addOptions = { exportOptions: { "columns" : ":visible" }};

                                $.extend(true,printButtonConfig,addOptions);
                                printButtonConfig.action(e, dt, button, printButtonConfig);
                            }).draw();
                        }
                    },
                    'selectAll',
                    'selectNone',
                ],
                language: {
                    buttons: {
                        colvis: 'Show/Hide Columns',
                    }
                },
                columnDefs: [
                    {
                        targets: [
                            2, 3, 6, 7, 8, 9, 10,
                            11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
                            21, 22, 23, 24, 25, 26, 27, 28, 29, 30,
                            31, 32, 33, 34, 35, 36, 37, 38, /*39,*/ 40,
                            41, 42, 43, 44, 45, 46,/* 47, 48, 49, 50,
                            51, 53, 54, 55, 56, 57, 58, 59, 60,
                            61, 62, 63, 64, 65, 66, 67, 68*/
                        ],
                        "visible": false
                    },
                    {
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    },
                ],
                select: {
                    style: 'multi',
                    // selector: 'td:first-child'
                },
            });

        });

        $(document).on('submit', '#form', function (event) {
            $('#sampleTable2').DataTable().ajax.reload();
        });

        /* For Export Buttons available inside jquery-datatable "server side processing" - Start
- due to "server side processing" jquery datatble doesn't support all data to be exported
- below function makes the datatable to export all records when "server side processing" is on */

        /*function newexportaction(e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function (e, s, data) {
                // Just this once, load all data from the server...
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function (e, settings) {
                    // Call the original action function
                    /!*if (button[0].className.indexOf('buttons-copy') >= 0) {
                        $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                        $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                        $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                        $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                    } else *!/if (button[0].className.indexOf('buttons-print') >= 0) {
                        $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                    }
                    dt.one('preXhr', function (e, s, data) {
                        // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                        // Set the property to what it was before exporting.
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                    setTimeout(dt.ajax.reload, 0);
                    // Prevent rendering of the full data to the DOM
                    return false;
                });
            });
            // Requery the server with the new one-time export settings
            dt.ajax.reload();
        };
        //For Export Buttons available inside jquery-datatable "server side processing" - End
        */
    </script>
@endpush
