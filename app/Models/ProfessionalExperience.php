<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class ProfessionalExperience extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = ['id'];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'employee';
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_id');
    }

}
