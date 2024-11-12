<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Short PDS</title>

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
            /*margin-top: 10px;*/
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
    </style>

</head>

<body>
{{ 'SHORT PDS' }}
<br>
{{\Carbon\Carbon::now()->format('d-m-Y h:i:s A')}}
<br>
<div id="bor_1">
    <div style="display: flex">
        <div class="left_title" style="width: 30%;">
            Heading Here
        </div>
        <div class="main_title" style="width: 30%; text-align: center;">
            @isset($logo->company_logo)
                <img id="companyLogo" style="width: auto; height: 70px;" src="{{ public_path('storage/' . $logo->company_logo) }}">
            @endisset
            @isset($company->company_name)
                <h4>{{ $company->company_name }}</h4>
            @endisset
        </div>
        <div class="mb-2" style="width: 40%;margin-bottom:15px">
            @if(!empty($employee->img_url))
            <img id="employeeImage" src="{{ public_path('profile_image/' . $employee->img_url) }}" alt="Employee picture" style="width: auto; height: 100px;">
            @else
                <img id="employeeImage" src="{{ public_path('assets/employee/default-user.png') }}" style="width: auto; height: 100px;">
            @endif
        </div>
    </div>
</div>
{{-- {{ logger($employee->last_promotion) }} --}}
<h4 style="margin-top:0; margin-bottom: 5px;"><u><b>GENERAL INFORMATION</b></u></h4>
<table class="text-normal">
    <tr>
        <td colspan="2" style="font-weight: bold">Name</td>
        <td colspan="2">{{ $employee->name ?? '' }}</td>
        <td style="font-weight: bold">STATION/OFFICE NAME</td>
        <td>{{ @$employee->jobStation->name }} {{ $employee->jobDistrict->name ?? '' }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold">OLD PIN</td>
        <td>{{ $employee->pin_no??'' }}</td>
        <td style="font-weight: bold">NEW PIN</td>
        <td>{{ $employee->new_pin??'' }}</td>
        <td style="font-weight: bold">ATTACHED STATION/OFFICE NAME</td>
        <td>{{ $employee->attachedStation->name ?? '' }} {{ $employee->attachedDistrict->name ?? '' }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">DESIGNATION</td>
        <td colspan="2">{{ $employee->designation->en_name ?? '' }}</td>
        <td style="font-weight: bold">HOME DISTRICT</td>
        <td>{{ $employee->parmanentAddress->district->name ?? '' }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">BATCH NO.</td>
        <td colspan="2">{{ $employee->batch_no ? $employee->batch_no.'-'.$employee->batch_no_ext : '' }}</td>
        <td style="font-weight: bold">LAST DATE OF TRANSFER</td>
        <td>{{ $employee->last_transfer->where('employee_id',$employee->id)->first() ? \Carbon\Carbon::parse($employee->last_transfer->where('employee_id',$employee->id)->first()->from_date)->format('d-m-Y') : '' }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">HIGHEST EDUCATION</td>
        <td colspan="2">{{ $employee->highest_education->examination ?? '' }}</td>
        <td style="font-weight: bold">LAST DATE OF PROMOTION</td>
        <td>{{ $employee->last_promotion->first() ? \Carbon\Carbon::parse($employee->last_promotion->first()->from_date)->format('d-m-Y') : '' }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">FATHER'S NAME</td>
        <td colspan="2">{{ $employee->f_name }}</td>
        <td style="font-weight: bold">DATE OF JOINING</td>
        <td>{{ $employee->join_date != null ? \Carbon\Carbon::parse($employee->join_date)->format('d-m-Y'):'' }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">MOTHER'S NAME</td>
        <td colspan="2">{{ $employee->m_name }}</td>
        <td style="font-weight: bold">DATE OF PRL</td>
        <td>{{ $employee->lpr_date != null ? \Carbon\Carbon::parse($employee->lpr_date)->format('d-m-Y'):'' }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">AGE</td>
        <td colspan="2">{{ $age }}</td>
        <td style="font-weight: bold">DATE OF BIRTH</td>
        <td id="dob">{{ $employee->dob != null ? \Carbon\Carbon::parse($employee->dob)->format('d-m-Y'):'' }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold">CONTACT NO.</td>
        <td colspan="2">{{ $employee->mobile_no }}</td>
    </tr>
</table>
<h4 style="margin: 0px; visibility: hidden;"><u><b>PUNISHMENT</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>PUNISHMENT</b></u></h4>
{{-- <table class="table table-hover table-bordered text-uppercase" id="" style="text-align: center">
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

<h4 style="margin: 0px; visibility: hidden;"><u><b>JOB HISTORY</b></u></h4>
<h4 style="margin-top: -10px; margin-bottom: 5px;"><u><b>JOB HISTORY</b></u></h4>
<table class="table table-hover table-bordered" id="" style="text-align: center">
    <tr>
        <th>STATION/OFFICE NAME</th>
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
</body>
</html>
