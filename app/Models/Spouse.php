<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Spouse extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['employee_id', 'name', 'tin', 'profession', 'district', 'total_child','relationship','organization_id', 'contact', 'dob'];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Spouse';
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
}
