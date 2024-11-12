<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LocalTrainedEmployee extends Pivot
{
    protected $table = 'employee_local_trainings';

    protected $casts = [
        'memo_date' => 'datetime:d-m-Y',
        'from_date' => 'datetime:d-m-Y',
        'to_date' => 'datetime:d-m-Y',
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function local_training(){
        return $this->belongsTo(LocalTraining::class);
    }
}
