<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Long PDS</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, td, th {
            /*font-weight: unset;*/
            text-align: center;
            padding-right: 10px;
            border: 1px solid black;
        }
        table, td, td {

            padding-left: 10px;
            text-align: left;
        }
        #bor_1{
            border: none !important;
        }

        .bb-none {
            border-bottom: 2px solid transparent;
        }

        .br-none {
            border-right: 2px solid #fff;
        }

        .bt-none {
            border-top: 2px solid #fff;
        }

        .bl-none {
            border-left: 2px solid #fff;
        }

        .tc {
            text-align: center;
        }

        .tr {
            text-align: right;
        }

        body {
            /*font-family: bangla;*/
            font-family: 'bangla', sans-serif;
            font-size: 13px;
        }

        .fs {
            font-size: 8px;
        }

        @page {
            /*margin-top: 25px;*/
            /*margin: 0;*/
            header: page-header;
            footer: page-footer;
        }

        @page :first {
            margin-top: 25px;
            /*margin: 0;*/
            header: page-header;
            footer: page-footer;
        }

        h1, h2, h3, h4, h5 {
            page-break-after: avoid;
        }

        .left_title{
            float: left;
            text-align: center;
            width: 120px;
            height: 120px;
            margin-left: 40px;
            border-radius: 2px;
        }
        .right_title{
            float: left;
            text-align: center;
            width: 120px;
            height: 120px;
            margin-left: 40px;
        }
        .main_title{
            float: left;
            margin-left: 50px;
        }
        .main_title h4{
            text-align: center !important;
        }
        #image{
            height: 100%;
            width: 100%;
        }
        #nominee_image{
            height: 70px;
            width: 70px;
        }
        /* .pdf_header{
            display: flex;
            flex-direction: column;
        }

        .heading, .main_title, .photo{
            flex-basis: 33.33%
        } */

    </style>

</head>

<body>

<htmlpageheader name="page-header">

</htmlpageheader>

<htmlpagefooter name="page-footer">

</htmlpagefooter>
{{ 'LONG PDS' }}
<br>
{{\Carbon\Carbon::now()->format('d-m-Y h:i:s A')}}
<br>

<div id="bor_1">
    <div class="pdf_header" style="width:100%">
        <div class="heading" width="20%" style="float:left">Heading text here</div>
        <div class="main_title" width="50%" style="text-align: center;">
            @if($logo!=null)
                <img id="image" style="width: 200px; height: 70px;" src="{{public_path('storage/'. $logo->company_logo)}}">
            @endif
            @if($company!=null)
                <span>
                    {{$company->company_name}}
                </span>
            @endif
        </div>
        <div class="photo" style="float:right; width:20%">
            @if(!empty($employee->img_url))
                <img id="employeeImage" src="{{ public_path('profile_image/' . $employee->img_url) }}" alt="Employee picture" style="width: auto; height: 100px;">
            @else
                <img id="employeeImage" src="{{ public_path('assets/employee/default-user.png') }}" style="width: auto; height: 100px;">
            @endif
        </div>
    </div>
</div>

<h4 style="margin-bottom: 5px; margin-top: 0px;"><u><b>GENERAL INFORMATION</b></u></h4>
<table class="text-uppercase">
    <tr>
        <td colspan="2" style="font-weight: bold">NAME</td>
        <td colspan="2">{{ App\Classes\StringConversion::stringToUpper($employee->name ?? '') }}</td>
        <td style="font-weight: bold">STATION/OFFICE NAME</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->jobStation->name ?? '') }} {{ $employee->jobDistrict ? App\Classes\StringConversion::stringToUpper(', '.$employee->jobDistrict->name ?? '') : '' }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold">OLD PIN</td>
        <td>{{ $employee->pin_no }}</td>
        <td style="font-weight: bold">NEW PIN</td>
        <td>{{ $employee->new_pin }}</td>
        <td style="font-weight: bold">ATTACHED STATION/OFFICE NAME</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->attachedStation->name ?? '') }} {{ $employee->attachedDistrict ? App\Classes\StringConversion::stringToUpper(', '.$employee->attachedDistrict->name ?? '') : '' }} </td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">DESIGNATION</td>
        <td colspan="2">{{ App\Classes\StringConversion::stringToUpper($employee->designation->en_name ?? '') }}</td>
        <td style="font-weight: bold">HOME DISTRICT</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->birth_district ?? '' ) }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">BATCH NO.</td>
        <td colspan="2">{{ App\Classes\StringConversion::stringToUpper($employee->batch_no ? $employee->batch_no.'-'.$employee->batch_no_ext : '') }}</td>
        <td style="font-weight: bold">LAST DATE OF TRANSFER</td>
        <td>{{ $employee->last_transfer->where('employee_id',$employee->id)->first() ? \Carbon\Carbon::parse($employee->last_transfer->where('employee_id',$employee->id)->first()->from_date)->format('d-m-Y') : '' }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">HIGHEST EDUCATION</td>
        <td colspan="2">{{ App\Classes\StringConversion::stringToUpper($employee->highest_education->examination ?? '') }}</td>
        <td style="font-weight: bold">LAST DATE OF PROMOTION</td>
        <td>{{ $employee->last_promotion->where('employee_id',$employee->id)->first() ? \Carbon\Carbon::parse($employee->last_promotion->where('employee_id',$employee->id)->first()->from_date)->format('d-m-Y') : '' }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">FATHER'S NAME</td>
        <td colspan="2">{{ App\Classes\StringConversion::stringToUpper($employee->f_name) }}</td>
        <td style="font-weight: bold">DATE OF JOINING</td>
        <td>{{ $employee->join_date != null ? \Carbon\Carbon::parse($employee->join_date)->format('d-m-Y'):'' }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">MOTHER'S NAME</td>
        <td colspan="2">{{ App\Classes\StringConversion::stringToUpper($employee->m_name) }}</td>
        <td style="font-weight: bold">DATE OF PRL</td>
        <td>{{ $employee->lpr_date != null ? \Carbon\Carbon::parse($employee->lpr_date)->format('d-m-Y'):'' }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">AGE</td>
        <td colspan="2">{{ App\Classes\StringConversion::stringToUpper($age) }}</td>
        <td style="font-weight: bold">DATE OF BIRTH</td>
        <td>{{ $employee->dob != null ? \Carbon\Carbon::parse($employee->dob)->format('d-m-Y'):'' }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">CONTACT NO.</td>
        <td colspan="2">{{ $employee->mobile_no }}</td>
    </tr>
</table>

@if($employee->spouses->count() > 0)
    <h4 style="margin: 0px; visibility: hidden;"><u><b>SPOUSE INFORMATION</b></u></h4>
    <h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>SPOUSE INFORMATION</b></u></h4>
    <table class="table table-hover table-bordered text-uppercase" id="">
        <tr>
            <th style="text-align: center;">SPOUSE NAME</th>
            <th style="text-align: center;">TIN NO.</th>
            <th style="text-align: center;">PROFESSION</th>
            <th style="text-align: center;">HOME DISTRICT</th>
            <th style="text-align: center;">TOTAL CHILD</th>
        </tr>
        @foreach($employee->spouses as $spouse)
            <tr>
                <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($spouse->name ?? '') }}</td>
                <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($spouse->tin ?? '') }}</td>
                <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($spouse->profession ?? '') }}</td>
                <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($spouse->district ?? '') }}</td>
                <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($spouse->total_child ?? '') }}</td>
            </tr>
        @endforeach
    </table>
@endif

<h4 style="margin: 0px; visibility: hidden;"><u><b>PERMANENT ADDRESS</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>PERMANENT ADDRESS</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="">
    <tr>
        <td style="font-weight: bold;">DIVISION</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->parmanentAddress->division->name ?? '') }}</td>
        <td style="font-weight: bold;">DISTRICT</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->parmanentAddress->district->name ?? '') }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">UPAZILA</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->parmanentAddress->upazila->name ?? '') }}</td>
        <td style="font-weight: bold;">POST OFFICE</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->parmanentAddress->post_office ?? '') }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">POSTAL CODE</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->parmanentAddress->postal_code ?? '') }}</td>
        <td style="font-weight: bold;">VILLAGE/ROAD/AREA</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->parmanentAddress->area ?? '') }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">UNION/CITY/CORPORATION/WARD</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->parmanentAddress->u_c_c_w ?? '') }}</td>
        <td style="font-weight: bold;">HOUSE/HOLDING NO</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->parmanentAddress->house_no ?? '') }}</td>
    </tr>
</table>

<h4 style="margin: 0px; visibility: hidden;"><u><b>PERSONAL INFORMATION</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>PERSONAL INFORMATION</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="">
    <tr>
        <td style="font-weight: bold;">EMERGENCY CONTACT NAME</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->e_contact_person_name) }}</td>
        <td style="font-weight: bold;">HOME CONTACT NUMBER</td>
        <td>{{$employee->home_contact_number}}</td>

    </tr>
    <tr>
        <td style="font-weight: bold;">EMERGENCY CONTACT RELATIONSHIP</td>
        <td>
            @foreach($relationships as $relation)
                @if($relation->id == $employee->e_contact_person_relation)
                    {{ App\Classes\StringConversion::stringToUpper($employee->e_contact_person_relation? $relation->name : 'n/a') }}
                @endif
            @endforeach
        </td>
        <td style="font-weight: bold;">EMERGENCY MOBILE NO</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->e_contact_person_number) }}</td>
    </tr>

    <tr>
        <td style="font-weight: bold;">NID NO</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->nid_no) }}</td>
        <td style="font-weight: bold;">PASPORT NO</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->passport_no) }}</td>
    </tr>

    <tr>
        <td style="font-weight: bold;" class="text-lowercase">EMAIL</td>
        <td>{{ $employee->email }}</td>
        <td style="font-weight: bold;">GPF NO</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->gpf_no) }}</td>
    </tr>

    <tr>
        <td style="font-weight: bold;">WELFARE NO</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->welfare_no) }}</td>
        <td style="font-weight: bold;">WOMEN'S WELFARE NO</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->womens_welfare_no) }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">ID CARD NO</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->id_card_no) }}</td>
        <td style="font-weight: bold;">BLOOD GROUP</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->blood_group) }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">GENDER</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->gender) }}</td>
        <td style="font-weight: bold;">TIN NO</td>
        <td>{{ App\Classes\StringConversion::stringToUpper($employee->e_tin_no) }}</td>
    </tr>
</table>

<h4 style="margin: 0px; visibility: hidden;"><u><b>EDUCATIONAL QUALIFICATIONS</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>EDUCATIONAL QUALIFICATIONS</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="" style="text-align: center">
    <tr>
        <th style="text-align: center;">EXAMINATION</th>
        <th style="text-align: center;">BOARD</th>
        <th style="text-align: center;">RESULT</th>
        <th style="text-align: center;">PASSING YEAR</th>
        <th style="text-align: center;">SUBJECT</th>
        <th style="text-align: center;">INSTITUTE/UNIVERSITY</th>
    </tr>
    @foreach($employee->educations as $education)
        <tr>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($education->examination) }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($education->board) }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($education->result) }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($education->passing_year) }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($education->subject) }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($education->institute) }}</td>
        </tr>
    @endforeach
</table>
{{-- experiences --}}
<h4 style="margin: 0px; visibility: hidden;"><u><b>EXPERIENCES</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>EXPERIENCES</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="">
    <thead>
        <tr>
            <th style="text-align: center;">Company Name</th> 
            <th style="text-align: center;">Job Position</th> 
            <th style="text-align: center;">Company Location</th>
            <th style="text-align: center;">Project Name</th>
            <th style="text-align: center;">Timeline</th>
        </tr>
    </thead>
    <tbody>
        @if($employee->getExperiences!=null)
        @foreach ($employee->getExperiences as $exp)
        <tr>
            <td style="text-align: center;">{{$exp->company_name}}</td>
            <td style="text-align: center;">{{ $exp->experienceJobPosition->name??'' }}</td>
            <td style="text-align: center;">{{$exp->company_location}}</td>
            <td style="text-align: center;">{{$exp->project_name}}</td>
            <td style="text-align: center;">{{$exp->from_date}}-{{$exp->to_date}}</td>
        </tr>
        @endforeach
    @endif
    </tbody>

</table>
{{-- // --}}
<h4 style="margin: 0px; visibility: hidden;"><u><b>PROFESSIONAL/OTHER EXPERIENCES</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>PROFESSIONAL/OTHER EXPERIENCES</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="">
    <tr>
        <th style="text-align: center;">DESIGNATION</th>
        <th style="text-align: center;">INSTITUTE/ORGANIZATION</th>
        <th style="text-align: center;">DURATION</th>
        <th style="text-align: center;">RESPONSIBILITIES</th>
    </tr>
    @foreach($employee->professional_experiences as $professional_experience)
        <tr>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($professional_experience->designation) }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($professional_experience->organization) }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($employee->calculateDuration($professional_experience->from_date,$professional_experience->to_date)) }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($professional_experience->responsibilities) }}</td>
        </tr>
    @endforeach
</table>

{{-- <h4 style="margin: 0px; visibility: hidden;"><u><b>AWARDS</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>AWARDS</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="" style="text-align: center">
    <thead>
    <tr>
        <th style="text-align: center;">AWARD NAME</th>
        <th style="text-align: center;">ISSUE AUTHORITIES</th>
        <th style="text-align: center;">MEMO NO</th>
        <th style="text-align: center;">MEMO DATE</th>
        <th style="text-align: center;">DATE</th>
        <th style="text-align: center;">DESCRIPTION</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employee->awards as $award)
        <tr>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($award->award_name ?? '' ) }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($award->pivot->issue_authorities ?? '' ) }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($award->pivot->memo_no ?? '' ) }}</td>
            <td style="text-align: center;">{{ $award->pivot->memo_date ? \Carbon\Carbon::parse($award->pivot->memo_date)->format('d-m-Y') : '' }}</td>
            <td style="text-align: center;">{{ $award->pivot->date ? \Carbon\Carbon::parse($award->pivot->date)->format('d-m-Y') : '' }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($award->pivot->description ?? '' ) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h4 style="margin: 0px; visibility: hidden;"><u><b>LEAVES</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>LEAVES</b></u></h4>
<table class="table table-bordered table-hover text-uppercase">
    <thead>
    <tr>
        <th>Leave Name</th>
        <th>Memo No</th>
        <th>Memo Date</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Duration</th>
        <th>Description</th>
        <th>Date of Creation</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employee->leaves as $leave)
        <tr>
            <td>{{ App\Classes\StringConversion::stringToUpper($leave->name) }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($leave->pivot->memo_no ?? '') }}</td>
            <td>{{ \Carbon\Carbon::parse($leave->pivot->memo_date ??'')->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($leave->pivot->from_date ??'')->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($leave->pivot->to_date ??'')->format('d-m-Y') }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($leave->pivot->duration) }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($leave->pivot->description) }}</td>
            <td>{{ \Carbon\Carbon::parse($leave->pivot->created_at ??'')->format('d-m-Y h:i:s A') }}</td>
        </tr>
    @endforeach
    </tbody>
</table> --}}

{{-- <h4 style="margin: 0px; visibility: hidden;"><u><b>ACHIEVEMENTS</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>ACHIEVEMENTS</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="" style="text-align: center">
    <thead>
    <tr>
        <th style="text-align: center;">ACHIEVEMENT NAME</th>
        <th style="text-align: center;">ISSUE AUTHORITIES</th>
        <th style="text-align: center;">MEMO NO</th>
        <th style="text-align: center;">MEMO DATE</th>
        <th style="text-align: center;">DATE</th>
        <th style="text-align: center;">DESCRIPTION</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employee->achievements as $achievement)
        <tr>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($achievement->achievement_name ?? '' ) }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($achievement->pivot->issue_authorities ?? '' ) }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($achievement->pivot->memo_no ?? '' ) }}</td>
            <td style="text-align: center;">{{ $achievement->pivot->memo_date ? \Carbon\Carbon::parse($achievement->pivot->memo_date)->format('d-m-Y') : '' }}</td>
            <td style="text-align: center;">{{ $achievement->pivot->date ? \Carbon\Carbon::parse($achievement->pivot->date)->format('d-m-Y') : '' }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($achievement->pivot->description ?? '' ) }}</td>
        </tr>
    @endforeach
    </tbody>
</table> --}}

<h4 style="margin: 0px; visibility: hidden;"><u><b>JOURNALS/PUBLICATIONS</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>JOURNALS/PUBLICATIONS</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="">
    <tr>
        <th>Title</th>
        <th>Publication</th>
        <th>Publication Date</th>
        <th>Author</th>
        <th>Publication URL</th>
    </tr>
    @foreach($employee->journals as $journal)
        <tr>
            <td>{{ App\Classes\StringConversion::stringToUpper($journal->title ?? '') }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($journal->publication ?? '') }}</td>
            <td>{{ $journal->publication_date ? \Carbon\Carbon::parse($journal->publication_date)->format('d-m-Y') : '' }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($journal->author ?? '') }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($journal->publication_url ?? '') }}</td>
        </tr>
    @endforeach
</table>

{{-- <h4 style="margin: 0px; visibility: hidden;"><u><b>PUNISHMENT</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>PUNISHMENT</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="" style="text-align: center">
    <thead>
    <tr>
        <th>PUNISHMENT NAME</th>
        <th>Complaint Description</th>
        <th>Departmental Case Memo No, Date & Section</th>
        <th>Settlement /Punishment Memo, Dateand Description of Punishment</th>
        <th>Appeal and disposal order along with the Secretary</th>
        <th>Case No. and Judgment of the Administrative Tribunal</th>
        <th>Case No. and judgment of the Administrative Appeal Tribunal</th>
        <th>Leave to Memo No.and Judgement</th>
        <th>Review Case No. and Judgment</th>
        <th>Comments</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employee->punishments as $punishment)
        <tr>
            <td style="width: 30px; text-align: center;">{{$punishment->name}}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($punishment->pivot->complaint_description ?? '') }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($punishment->pivot->departmental_case_memo_no_date_and_section ?? '') }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($punishment->pivot->settlement_punishment_memo_date_and_description_of_punishment ?? '') }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($punishment->pivot->appeal_and_disposal_order_along_with_the_secretary ?? '') }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($punishment->pivot->case_no_and_judgment_of_the_administrative_tribunal ?? '') }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($punishment->pivot->case_no_and_judgment_of_the_administrative_appeal_tribunal ?? '') }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($punishment->pivot->leave_to_memo_no_and_judgement ?? '') }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($punishment->pivot->review_case_no_and_judgement ?? '') }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($punishment->pivot->comments ?? '') }}</td>
        </tr>
    @endforeach
    </tbody>
</table> --}}

<h4 style="margin: 0px; visibility: hidden;"><u><b>PUNISHMENT</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>NOMINEE INFORMATION</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="" style="text-align: center">
    <tr>
        <th>NAME</th>
        <th>RELATIONSHIP</th>
        <th>PERMANENT ADDRESS</th>
        <th>NID NO</th>
        <th>PERCENTAGE</th>
        <th>PICTURE</th>
    </tr>
    @foreach($employee->nominees as $nominee)
        <tr>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($nominee->name ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($nominee->nomineeRelationship->name ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($nominee->permanent_address ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($nominee->nid_no ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($nominee->percentage ?? '') }} %</td>
            <td style="text-align: center;">
                @if(!is_null($nominee->picture_url))
                    <img id="nominee_image" src="{{ $nominee->picture_url ? public_path('nominee_picture/'.$nominee->picture_url) : public_path('assets/employee/default-user.png') }}">
                @else

                @endif
            </td>
        </tr>
    @endforeach
</table>
{{-- <h4 style="margin: 0px; visibility: hidden;"><u><b>ABROAD TRAINING</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>ABROAD TRAINING</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="" style="text-align: center">
    <tr>
        <th>COURSE TITLE</th>
        <th>COURSE CODE</th>
        <th>COUNTRY</th>
        <th>START DATE</th>
        <th>END DATE</th>
        <th>DURATION</th>
        <th>MEMO NO</th>
        <th>MEMO DATE</th>
        <th>COURSE COORDINATOR</th>
        <th>VENUE</th>
        <th>RESULT</th>
    </tr>
    @foreach($employee->foreign_trainings as $foreign_training)
        <tr>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->course_title ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->course_code ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->pivot->country->name ?? '') }}</td>
            <td style="text-align: center;">{{ $foreign_training->pivot->from_date ? \Carbon\Carbon::parse($foreign_training->pivot->from_date)->format('d-m-Y') : ''}}</td>
            <td style="text-align: center;">{{ $foreign_training->pivot->to_date ? \Carbon\Carbon::parse($foreign_training->pivot->to_date)->format('d-m-Y') : ''}}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->pivot->duration ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->pivot->memo_number ?? '') }}</td>
            <td style="text-align: center;">{{ $foreign_training->pivot->memo_date ? \Carbon\Carbon::parse($foreign_training->pivot->memo_date)->format('d-m-Y') : ''}}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->pivot->course_coordinator ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->pivot->venue ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->pivot->result ?? '') }}</td>
        </tr>
    @endforeach
</table>
<h4 style="margin: 0px; visibility: hidden;"><u><b>ABROAD TRAINING</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>ABROAD TRAINING</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="" style="text-align: center">
    <tr>
        <th>COURSE TITLE</th>
        <th>COURSE CODE</th>
        <th>COUNTRY</th>
        <th>START DATE</th>
        <th>END DATE</th>
        <th>DURATION</th>
        <th>MEMO NO</th>
        <th>MEMO DATE</th>
        <th>COURSE COORDINATOR</th>
        <th>VENUE</th>
        <th>RESULT</th>
    </tr>
    @foreach($employee->foreign_trainings as $foreign_training)
        <tr>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->course_title ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->course_code ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->pivot->country->name ?? '') }}</td>
            <td style="text-align: center;">{{ $foreign_training->pivot->from_date ? \Carbon\Carbon::parse($foreign_training->pivot->from_date)->format('d-m-Y') : ''}}</td>
            <td style="text-align: center;">{{ $foreign_training->pivot->to_date ? \Carbon\Carbon::parse($foreign_training->pivot->to_date)->format('d-m-Y') : ''}}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->pivot->duration ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->pivot->memo_number ?? '') }}</td>
            <td style="text-align: center;">{{ $foreign_training->pivot->memo_date ? \Carbon\Carbon::parse($foreign_training->pivot->memo_date)->format('d-m-Y') : ''}}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->pivot->course_coordinator ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->pivot->venue ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($foreign_training->pivot->result ?? '') }}</td>
        </tr>
    @endforeach
</table>

<h4 style="margin: 0px; visibility: hidden;"><u><b>INLAND TRAINING</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>INLAND TRAINING</b></u></h4>
<table class="table table-bordered table-hover text-uppercase">
    <thead>
    <tr>
        <th>COURSE TITLE</th>
        <th>COURSE CODE</th>
        <th>COUNTRY</th>
        <th>START DATE</th>
        <th>END DATE</th>
        <th>DURATION</th>
        <th>MEMO NO</th>
        <th>MEMO DATE</th>
        <th>COURSE COORDINATOR</th>
        <th>VENUE</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employee->local_trainings as $local_training)
        <tr>
            <td>{{ App\Classes\StringConversion::stringToUpper($local_training->course_title ?? '') }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($local_training->course_code ?? '') }}</td>
            <td>{{ 'BANGLADESH' }}</td>
            <td>{{ $local_training->pivot->from_date ? \Carbon\Carbon::parse($local_training->pivot->from_date)->format('d-m-Y') : '' }}</td>
            <td>{{ $local_training->pivot->to_date ? \Carbon\Carbon::parse($local_training->pivot->to_date)->format('d-m-Y') : '' }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($local_training->pivot->duration ?? '' ) }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($local_training->pivot->memo_number ?? '' ) }}</td>
            <td>{{ $local_training->pivot->memo_date ? \Carbon\Carbon::parse($local_training->pivot->memo_date)->format('d-m-Y') : '' }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($local_training->pivot->course_coordinator ?? '' ) }}</td>
            <td>{{ App\Classes\StringConversion::stringToUpper($local_training->pivot->venue ?? '' ) }}</td>
        </tr>
    @endforeach
    </tbody>
</table> --}}

<h4 style="margin: 0px; visibility: hidden;"><u><b>TRAINING Information</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>TRAINING Information</b></u></h4>
<table class="table table-bordered table-hover text-uppercase">
    <thead>
    <tr>
        <th>COURSE TITLE</th>
        <th>START DATE</th>
        <th>END DATE</th>
        <th>COUNTRY</th>
        <th>Course Description</th>
        <th>TYPE</th>
        <th>Institute</th>
        <th>RESULT</th>
        <th>YEAR</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employee->getTraining as $training)
        <tr>
            <td>{{ $training->course_title ?? '' }}</td>
            <td>{{ \Carbon\Carbon::parse($training->course_start_date)->format('d-m-Y') ?? '' }}</td>
            <td>{{\Carbon\Carbon::parse($training->course_end_date)->format('d-m-Y') ?? '' }}</td>
            <td>{{ 'BANGLADESH' }}</td>
            <td>{{ $training->course_description??''}}</td>
            <td>{{ $training->training_type??'' }}</td>
            <td>{{ $training->institute_name??''}}</td>
            <td>{{ $training->result??''}}</td>
            <td>{{ $training->year??''}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h4 style="margin: 0px; visibility: hidden;"><u><b>JOB HISTORY</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>JOB HISTORY</b></u></h4>
<table class="table table-hover table-bordered text-uppercase" id="" style="text-align: center">
    <tr>
        <th>OFFICE/STATION NAME</th>
        <th>DESIGNATION</th>
        <th>GRADE</th>
        <th>FROM</th>
        <th>TO</th>
        <th>DURATION</th>
        <th>TYPE</th>
        <th>DESCRIPTION</th>
    </tr>
    @foreach($employee->posting_records as $posting_record)
        <tr>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper(@$posting_record->station->name.' ['.@$posting_record->station->code.']') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($posting_record->designation->en_name  ?? '') }}</td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($posting_record->grade->grade  ?? '') }}</td>
            <td style="text-align: center;">{{$posting_record->from_date ?? ''}}</td>
            <td style="text-align: center;">{{$posting_record->to_date ? $posting_record->to_date : 'PRESENT'}}</td>
            <td style="text-align: center;">
                @if($posting_record->from_date != null && $posting_record->to_date == null)
                    {{ App\Classes\StringConversion::stringToUpper($employee->posting_records->first()->employee->calculateDuration($posting_record->from_date,now())) }}
                @else
                    {{ App\Classes\StringConversion::stringToUpper($posting_record->duration??'') }}
                @endif
            </td>
            <td>
                @if($posting_record->type == 'transfer')
                    {{ 'TRANSFER' }}
                @elseif($posting_record->type == 'promotion')
                    {{ 'PROMOTION' }}
                @elseif($posting_record->type == 'joined')
                    {{ 'JOINED' }}
                @elseif($posting_record->type == 'administrative_transfer')
                    {{ 'Administrative Transfer' }}
                @elseif($posting_record->type == 'end_of_service')
                    {{ 'End of Service' }}
                @elseif($posting_record->type == 'attachment')
                    {{ 'Attachment' }}
                @elseif($posting_record->type == 'both')
                    {{ 'PROMOTION & TRANSFER' }}
                @endif
            </td>
            <td style="text-align: center;">{{ App\Classes\StringConversion::stringToUpper($posting_record->description ?? '') }}</td>
        </tr>
    @endforeach
</table>
<script>
    $('document').ready(function () {
        //fetch duration of date
        let birth_date = moment($('#dob').html(), 'DD-MM-YYYY');
        let lpr_date = moment($('#lpr').html(), 'DD-MM-YYYY');
        let to_date = moment();
        console.log('f: '+birth_date+' l: '+lpr_date+' t: '+to_date)

        if (birth_date.isValid() && to_date.isValid()) {
            $('#age').html(calculate_difference(birth_date,to_date));
        } else {
            console.log('AGE: Invalid date(s).')
        }

        if (lpr_date.isValid() && to_date.isValid()) {
            $('#lpr').html(calculate_difference(to_date,lpr_date));
        } else {
            console.log('LPR: Invalid date(s).')
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

    });
</script>
</body>
</html>
