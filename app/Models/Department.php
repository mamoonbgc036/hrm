<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class Department extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $fillable = [
        'name',
        'bn_name',
        'status',
        'created_by',
        'updated_by'
    ];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Department';
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function posting_records()
    {
        return $this->hasMany(PostingRecord::class, 'department_id', 'id');
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
