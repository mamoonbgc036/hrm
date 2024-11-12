<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary_template extends Model
{
    use HasFactory;
    protected $table = "salary_template";
    protected $fillable = ["grade_id", "basic_salary", "overtime_salary"];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function allowances()
    {
        return $this->hasMany(Salary_allowance::class, 'salary_template_id', 'id');
    }
    public function deduction()
    {
        return $this->hasMany(Salary_deduction::class, 'salary_template_id', 'id');
    }

    public function employee()
    {
        return $this->hasMany(Employee::class, 'grade_id', 'grade_id');
    }

    public function postingRecords()
    {
        return $this->hasMany(PostingRecord::class);
    }
    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }
}
