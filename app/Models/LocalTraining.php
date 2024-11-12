<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class LocalTraining extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $guarded = ['id'];
    protected $table = 'local_trainings';
    protected $fillable = [
        'hr_id',
        'course_title',
        'location',
        'from_date',
        'to_date',
        'duration',
        'description',
        'course_code',
        'memo_number',
        'memo_date',
        'result',
        'course_coordinator',
        'country_id',
        'venue'
    ];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Inland Training';
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_local_trainings')
            ->wherePivot('status', 'active')
            ->withPivot('id', 'country_id', 'venue', 'location', 'memo_number', 'memo_date', 'result', 'course_coordinator', 'from_date', 'to_date', 'duration', 'description')
            ->withTimestamps()
            ->latest('from_date')
            ->using(LocalTrainedEmployee::class);
    }

    public function hr_number()
    {
        $serial = (LocalTraining::withTrashed()->latest()->first()->id ?? '1') + 100;
        $this->hr_id = "LT-" . date('my') . $serial;
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
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
        return $value ? Carbon::parse($value)->format('d-m-Y') : '';
    }

    public function approvedEmployees()
    {
        return $this->belongsToMany(Employee::class, 'employee_local_trainings')
            ->wherePivot('status', 'active')
            ->withPivot('id', 'country_id', 'venue', 'location', 'memo_number', 'memo_date', 'result', 'course_coordinator', 'from_date', 'to_date', 'duration', 'description')
            ->withTimestamps()
            ->latest('from_date')
            ->using(LocalTrainedEmployee::class);
    }
}
