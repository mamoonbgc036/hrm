<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            /*'first_name' => 'required',
            'last_name' => 'required',
            'first_name_bn' => 'required',
            'last_name_bn' => 'required',
            'f_name' => 'required',
            'm_name' => 'required',
            'pn_no' => 'required|unique:employees',
            'location' => 'required',
            'batch_no' => 'required',
            'designation_id' => 'required',
            'posting_station_id' => 'required',
            'e_home_district_id' => 'required',
            'post_office' => 'required',
            'dob' => 'required',
            'join_date' => 'required',
            'lpr_date' => 'required',
            's_name' => 'required',
            's_home_district_id' => 'required',
            'mobile' => 'required|numeric|unique:employees|digits:11',
            'alter_mobile' =>  'numeric|unique:employees|digits:11',
            'emergency_contact' => 'required' ,
            'emergency_mobile' =>  'required|numeric|digits:11',
            'email' => 'required|unique:employees|email',
            'nid_no' => 'required|unique:employees',
            'passport_no' => 'required|unique:employees',
            'welfare_no' => 'required|unique:employees',
            'id_card_no' => 'required|unique:employees',
            'gpf_no' => 'required|unique:employees',
            'blood_group' => 'required',
            'no_of_children' => 'required',
            'img_url' => 'nullable|mimes:jpeg,png|max:2024',*/
        ];
    }
}
