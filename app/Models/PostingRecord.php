<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class PostingRecord extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $guarded = ['id'];
    protected $table = 'posting_records';
    protected $fillable = [
        'employee_id',
        'designation_id',
        'department_id',
        'grade_id',
        'station_id',
        'station_name',
        'station_location',
        'from_date',
        'to_date',
        'duration',
        'description'
    ];


    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Job History';
    protected static $logOnlyDirty = true;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id');
    }

    public function monthly_grade()
    {
        return $this->hasOne(Salary_template::class, 'grade_id', 'grade_id');
    }

    public static function posting_types()
    {
        return [
            'joined' => 'Joined',
            'administrative_transfer' => 'Administrative Transfer',
            'transfer' => 'Transfer',
            'promotion' => 'Promotion',
            'both' => 'Transfer & Promotion',
            'end_of_service' => 'End of Service',
            'attachment' => 'Attachment',
        ];
    }

    public function getFromDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getToDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : '';
    }
}
