<?php

namespace App\Models;

use App\Models\ExperienceJobPosition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
{
    use HasFactory;
    protected $fillable=["employee_id","company_name","job_position","company_location","project_name","from_date","to_date","job_responsibility"];

    public function experienceJobPosition(){
        return $this->belongsTo(ExperienceJobPosition::class, 'job_position', 'id');
    }
}
