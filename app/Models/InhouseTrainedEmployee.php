<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class InhouseTrainedEmployee extends Pivot
{
    protected $table = 'employee_inhouse_training';

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

    public function inhouse_training(){
        return $this->belongsTo(InhouseTraining::class);
    }
}
