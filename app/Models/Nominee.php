<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class Nominee extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $guarded = ['id'];
    protected $table = 'nominees';
    protected $fillable = [
        'employee_id',
        'relationship_id',
        'relationship',
        'name',
        'picture_url',
        'signature',
        'permanent_address',
        'percentage',
        'nid_no'
    ];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Nominee';
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function relationships()
    {
        return $this->belongsTo(Relationship::class, 'relationship_id');
    }
    public function nomineeRelationship()
    {
        return $this->hasOne(Relationship::class, 'id', 'relationship');
    }
}

