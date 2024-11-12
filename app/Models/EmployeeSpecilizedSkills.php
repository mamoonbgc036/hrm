<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSpecilizedSkills extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'employee_id'];

    public function specilizedSkill(){
        return $this->belongsTo(Specialized::class, 'name', 'id');
    }
}
