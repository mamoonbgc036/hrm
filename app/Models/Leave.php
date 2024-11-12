<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class Leave extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $guarded = ['id'];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Leave';
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_leaves')
            ->wherePivot('status', 'active')
            ->withPivot('memo_no', 'memo_date', 'from_date', 'to_date', 'duration', 'description', 'status')
            ->withTimestamps()
            ->using(LeaveEmployee::class);
    }

    public function approvedEmployees()
    {
        return $this->belongsToMany(Employee::class, 'employee_leaves')
            ->withPivot('id', 'memo_no', 'memo_date', 'from_date', 'to_date', 'duration', 'description', 'status')
            ->withTimestamps()
            ->wherePivot('status', 'active');
    }

}
