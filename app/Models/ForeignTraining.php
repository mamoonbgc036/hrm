<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class ForeignTraining extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $guarded = ['id'];
    protected $table = 'foreign_trainings';
    protected $fillable = [
        'hr_id',
        'country_id',
        'course_title',
        'from_date',
        'to_date',
        'duration',
        'description',
        'course_code',
        'memo_number',
        'memo_date',
        'result',
        'course_coordinator',
        'venue'
    ];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Abroad Training';
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_foreign_trainings')
            ->wherePivot('status', 'active')
            ->withPivot('id', 'country_id', 'venue', 'memo_number', 'memo_date', 'result', 'course_coordinator', 'from_date', 'to_date', 'duration', 'description')
            ->withTimestamps()
            ->latest('from_date')
            ->using(ForeignTrainedEmployee::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function hr_number()
    {
        $serial = (ForeignTraining::withTrashed()->latest()->first()->id ?? '1') + 100;
        $this->hr_id = "FT-" . date('my') . $serial;
    }

    public function getFromDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getToDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getMemoDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function approvedEmployees()
    {
        return $this->belongsToMany(Employee::class, 'employee_foreign_trainings')
            ->wherePivot('status', 'active')
            ->withPivot('id', 'country_id', 'venue', 'memo_number', 'memo_date', 'result', 'course_coordinator', 'from_date', 'to_date', 'duration', 'description')
            ->withTimestamps()
            ->latest('from_date')
            ->using(ForeignTrainedEmployee::class);
    }

}
