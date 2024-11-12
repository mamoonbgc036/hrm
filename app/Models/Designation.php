<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class Designation extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $guarded = ['id'];
    protected $fillable = [
        'bn_name',
        'en_name',
        'short_name',
        'status',
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
    protected static $logName = 'Designation';
    protected static $logOnlyDirty = true;

    public function posting_records()
    {
        return $this->hasMany(PostingRecord::class);
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
