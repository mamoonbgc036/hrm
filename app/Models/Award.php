<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class Award extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $guarded = ['id'];
    protected $table = 'awards';
    protected $fillable = [
        'hr_id',
        'award_name',
        'description',
        'created_by_id',
        'last_updated_by_id',
        'created_by',
        'last_updated_by'
    ];

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Award';
    protected static $logOnlyDirty = true;

    public function hr_award_number()
    {
        $serial = (Award::withTrashed()->latest()->first()->id ?? '1') + 100;
        $this->hr_id = "AR-" . date('my') . $serial;
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_awards')
            ->wherePivot('status', 'active')
            ->withPivot('issue_authorities', 'memo_no', 'memo_date', 'date', 'description', 'status')
            ->withTimestamps()
            ->using(AwardEmployee::class);
    }

    public function approvedEmployees()
    {
        return $this->belongsToMany(Employee::class, 'employee_awards')
            ->wherePivot('status', 'active')
            ->withPivot('issue_authorities', 'memo_no', 'memo_date', 'date', 'description', 'status')
            ->withTimestamps();

    }

    public function pendingEmployees()
    {
        return $this->belongsToMany(Employee::class, 'employee_awards')->where('status', '=', 'inactive');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'last_updated_by_id');
    }


}
