<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class District extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $guarded = ['id'];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'District';
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function upazilas()
    {
        return $this->hasMany(Upazila::class);
    }
}
