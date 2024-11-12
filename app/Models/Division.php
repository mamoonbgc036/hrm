<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class Division extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $guarded = ['id'];


    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Division';
    protected static $logOnlyDirty = true;

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
