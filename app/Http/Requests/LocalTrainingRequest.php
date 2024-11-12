<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalTrainingRequest extends FormRequest
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
            'course_title'=>'required|string|unique:local_trainings',
            'country'=>'',
            'from_date'=>'required',
            'to_date'=>'required',
            'duration'=>'',
            'description'=>'',
            'memo_number'=>'',
            'memo_date'=>'',
            'result'=>'',
            'venue'=>'',
            'course_code'=>'',
            'course_coordinator'=>'',
            'location'=>'',
        ];
    }
}
