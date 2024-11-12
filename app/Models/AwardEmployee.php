<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class AwardEmployee extends Pivot
{
    protected $table = 'employee_awards';

    protected $casts = [
        'memo_date' => 'datetime:d-m-Y',
        'date' => 'datetime:d-m-Y',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function award(){
        return $this->belongsTo(Award::class);
    }
}
