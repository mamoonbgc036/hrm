<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use Spatie\Activitylog\Traits\LogsActivity;

class Punishment extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $guarded = ['id'];
    protected $table = 'punishments';
    protected $fillable = [
        'name',
        'offence',
        'from_date',
        'to_date',
        'duration',
        'description',
        'complaint_description',
        'departmental_case_memo_no_date_and_section',
        'settlement_punishment_memo_date_and_description_of_punishment',
        'appeal_and_disposal_order_along_with_the_secretary',
        'case_no_and_judgment_of_the_administrative_tribunal',
        'case_no_and_judgment_of_the_administrative_appeal_tribunal',
        'leave_to_memo_no_and_judgement',
        'review_case_no_and_judgement',
        'comments'
    ];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Punishment';
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_punishments')
            ->wherePivot('status', 'active')
            ->withPivot('id', 'offence', 'action', 'from_date', 'to_date', 'duration', 'description', 'complaint_description', 'departmental_case_memo_no_date_and_section', 'settlement_punishment_memo_date_and_description_of_punishment', 'appeal_and_disposal_order_along_with_the_secretary', 'case_no_and_judgment_of_the_administrative_tribunal', 'case_no_and_judgment_of_the_administrative_appeal_tribunal', 'leave_to_memo_no_and_judgement', 'review_case_no_and_judgement', 'comments')
            ->using(PunishmentEmployee::class)
            ->withTimestamps();
    }

    public function getFromDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getToDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function approvedEmployees()
    {
        return $this->belongsToMany(Employee::class, 'employee_punishments')
            ->wherePivot('status', 'active')
            ->withPivot('id', 'offence', 'action', 'from_date', 'to_date', 'duration', 'description', 'complaint_description', 'departmental_case_memo_no_date_and_section', 'settlement_punishment_memo_date_and_description_of_punishment', 'appeal_and_disposal_order_along_with_the_secretary', 'case_no_and_judgment_of_the_administrative_tribunal', 'case_no_and_judgment_of_the_administrative_appeal_tribunal', 'leave_to_memo_no_and_judgement', 'review_case_no_and_judgement', 'comments')
            ->withTimestamps();
    }

}
