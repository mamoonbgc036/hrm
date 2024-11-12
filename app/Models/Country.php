<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class Country extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Country';
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function employee()
    {
        return $this->hasMany(Employee::class, 'employee_id');
    }
}
