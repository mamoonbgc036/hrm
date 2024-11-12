<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class Grade extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $fillable = [
        'name',
        'status'
    ];

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Grade';
    protected static $logOnlyDirty = true;

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
    public function getGrade()
    {
        return $this->hasOne(Salary_template::class,'id','grade_id');
    }

}