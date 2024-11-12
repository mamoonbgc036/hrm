<?php

namespace App\Models;

use App\Models\Nominee;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Relationship extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;


    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'description'
    ];

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Relationship';
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }

    public function nominee()
    {
        return $this->belongsTo(Nominee::class, 'relationship', 'id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'e_contact_person_relation', 'id');
    }

}
