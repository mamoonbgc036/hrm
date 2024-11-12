<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    public function map($data): array{

        $nominee_name = '';
        $nominee_address = '';
        $nominee_nid = '';
        $nominee_percentage = '';
        $nominee_relationship = '';
        foreach ($data->nominees as $key => $nominee){
            $nominee_name .= 1+$key.'. '.$nominee->name.' ';
            $nominee_address .= 1+$key.'. '.$nominee->permanent_address.' ';
            $nominee_nid .= 1+$key.'. '.$nominee->nid_no.' ';
            $nominee_percentage .= 1+$key.'. '.$nominee->percentage.' ';
            $nominee_relationship .= 1+$key.'. '.$nominee->relationship.' ';
        }

        $spouse_name = '';
        $spouse_tin = '';
        $spouse_profession = '';
        $spouse_district = '';
        $spouse_total_child = '';
        foreach ($data->spouses as $key => $spouse){
            $spouse_name .= 1+$key.'. '.$spouse->name.' ';
            $spouse_tin .= 1+$key.'. '.$spouse->tin.' ';
            $spouse_profession .= 1+$key.'. '.$spouse->profession.' ';
            $spouse_district .= 1+$key.'. '.$spouse->district.' ';
            $spouse_total_child .= 1+$key.'. '.$spouse->total_child.' ';
        }

        $rows = [
            // basic data
            $data->name,
            $data->name_bn,
            $data->f_name,
            $data->m_name,
            $data->pin_no,
            $data->new_pin,
            $data->religion,
            @$data->highest_education->examination,
            $data->blood_group,
            $data->batch_no.'-'.$data->batch_no_ext,
            $data->id_card_no,
            $data->gpf_no,
            $data->welfare_no,
            $data->womens_welfare_no,
            $data->passport_no,
            $data->nid_no,
            $data->e_tin_no,
            $data->gender,

            // personal data
            $data->dob,
            $data->join_date,
            $data->lpr_date,
            $data->age,
            $data->birth_country,
            $data->birth_district,
            $data->nationality,
            $data->disability_code,
            $data->quota,
            $data->marital_status,

            // spouses
            $spouse_name,
            $spouse_tin,
            $spouse_profession,
            $spouse_district,
            $spouse_total_child,

            // contact data
            $data->mobile_no,
            $data->alter_mobile,
            $data->email,
            $data->alter_email,
            $data->home_contact_number,
            $data->e_contact_person_name,
            $data->e_contact_person_number,
            $data->e_contact_person_relation,

            // presentAddress
            $data->presentAddress->division->name ?? '',
            $data->presentAddress->district->name ?? '',
            $data->presentAddress->upazila->name ?? '',
            $data->presentAddress->post_office ?? '',
            $data->presentAddress->postal_code  ?? '',
            $data->presentAddress->area ?? '',
            $data->presentAddress->u_c_c_w ?? '',
            $data->presentAddress->house_no ?? '',

            // parmanentAddress
            $data->parmanentAddress->division->name ?? '',
            $data->parmanentAddress->district->name ?? '',
            $data->parmanentAddress->upazila->name ?? '',
            $data->parmanentAddress->post_office ?? '',
            $data->parmanentAddress->postal_code ?? '',
            $data->parmanentAddress->area ?? '',
            $data->parmanentAddress->u_c_c_w ?? '',
            $data->parmanentAddress->house_no ?? '',

            // designation
            $data->designation->en_name ?? '',
            $data->designation->bn_name ?? '',
            $data->designation ? $data->designation->short_name : '',

            // job assign
            $data->jobGrade ? $data->jobGrade->grade : '',
            $data->jobStation ? $data->jobStation->name : '',
            $data->jobOffice ? $data->jobOffice->office : '',
            $data->jobDivision ? $data->jobDivision->name : '',
            $data->jobDistrict ? $data->jobDistrict->name : '',
            $data->jobUpazila ? $data->jobUpazila->name : '',

            // body details
            $data->height,
            $data->weight,
            $data->identification,

            // nominees
            $nominee_name,
            $nominee_address,
            $nominee_nid,
            $nominee_percentage,
            $nominee_relationship,

        ];


        return $rows;
    }

    public function collection(){
        return Employee::with(['presentAddress','parmanentAddress', 'posting_station','nominees','spouses','all_educations'])->get();
    }

    public function headings() : array{
        return ["Name", "Name (Bangla)", "Father Name", "Mother Name", "Old PIN", "New PIN", "Religion", "Highest Education", "Blood Group", "Batch No", "ID Card No", "GPF Number", "Welfare Number", "Women's Welfare Number", "Passport No", "NID No", "E-TIN Number", "Gender", "Date of Birth", "Join Date", "Retired Date", "Age", "Country of Birth", "District of Birth", "Nationality", "Disability Code", "Quota", "Marital Status", "Spouse Name", "Spouse TIN", "Spouse Profession", "Spouse District", "Spouse Total Child", "Mobile Number", "Alter Mobile", "Email", "Alter Email", "Home Contact Number", "Emergency Contact Person Name", "Emergency Contact Person Number", "Emergency Contact Person Relationship", "Present Address Division", "Present Address District", "Present Address Upazilla", "Present Address Post Office", "Present Address Postal Code", "Present Address Area", "Present Address Union/Ward/City-Corporation", "Present Address House/Holding No", "Permanent Address Division", "Permanent Address District", "Permanent Address Upazilla", "Permanent Address Post Office", "Permanent Address Postal Code", "Permanent Address Area", "Permanent Address Union/Ward/City-Corporation", "Permanent Address House/Holding No", "Designation Name (English)", "Designation Name (Bangla)", "Designation Name(Short)", "Job Grade", "Job Station Name", "Job Office Name", "Job Office Division", "Job Office District", "Job Office Upazila", "Height", "Weight", "Identification Mark", "Nominee Name", "Nominee Permanent Address", "Nominee NID", "Nominee Percentage", "Nominee Relationship"];

    }
}
