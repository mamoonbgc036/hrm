<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LeaveEmployee extends Pivot
{
    protected $table = 'employee_leaves';

    protected $casts = [
        'memo_date' => 'datetime:d-m-Y',
        'from_date' => 'datetime:d-m-Y',
        'to_date' => 'datetime:d-m-Y',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function leave(){
        return $this->belongsTo(Leave::class);
    }
}
