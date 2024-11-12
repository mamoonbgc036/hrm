<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Spatie\Activitylog\Traits\LogsActivity;

class Station extends Model
{
    // //use HasFactory, SoftDeletes, LogsActivity;




    protected $guarded = ['id'];
    protected $table = 'stations';
    protected $fillable = [
        'station_category_id',
        'name',
        'bn_name',
        'division_id',
        'district_id',
        'upazila_id',
        'phone',
        'area',
        'code',
        'status'
    ];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Station';
    protected static $logOnlyDirty = true;

    public function scopeActive($query)
    {
        $query->where('status', 'active');
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function posting_records()
    {
        return $this->hasMany(PostingRecord::class);
    }

    public function stationCategory()
    {
        return $this->belongsTo(StationCategory::class);
    }
}
