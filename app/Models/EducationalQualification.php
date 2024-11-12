<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class EducationalQualification extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = ['id'];
    protected $table = 'educational_qualifications';

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Educational Qualification';
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

    public static function types()
    {
        return [
            'jsc',
            'ssc',
            'hsc',
            'graduation',
            'masters',
            'more'
        ];
    }

    public static function durations()
    {
        return [
            '01 Year',
            '02 Years',
            '03 Years',
            '04 Years',
            '05 Years',
        ];
    }

    public static function results()
    {
        return [
            'PASS',
            '1ST DIVISION',
            '2ND DIVISION',
            '3RD DIVISION'
        ];
    }

}
