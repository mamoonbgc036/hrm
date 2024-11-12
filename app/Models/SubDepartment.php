<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class SubDepartment extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $fillable = [
        'department_id',
        'name',
        'bn_name',
        'status',
        'created_by',
        'updated_by'
    ];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Sub Department';
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}
