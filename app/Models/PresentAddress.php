<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class PresentAddress extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'employee_id',
        'division_id',
        'district_id',
        'upazila_id',
        'post_office',
        'postal_code',
        'area',
        'u_c_c_w',
        'house_no',
        'country_id'
    ];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Present Address';
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
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
}
