<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'course_title',
        'course_start_date',
        'course_end_date',
        'course_description',
        'training_type',
        'institute_name',
        'institute_address',
        'result',
        'year',
    ];
}
