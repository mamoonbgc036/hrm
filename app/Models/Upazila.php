<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class Upazila extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Upazila';
    protected static $logOnlyDirty = true;

    protected $appends = ['branch'];


    protected $guarded = ['id'];

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function getBranchAttribute()
    {
        return $this->name . ' Branch';
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function villages()
    {
        return $this->hasMany(Village::class, 'upazila_id', 'id');
    }
}
