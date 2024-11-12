<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Batch extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by'
    ];

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Batch';
    protected static $logOnlyDirty = true;

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}
