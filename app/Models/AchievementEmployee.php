<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AchievementEmployee extends Pivot
{
    protected $casts = [
        'memo_date' => 'datetime:d-m-Y',
        'date' => 'datetime:d-m-Y',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function achievement(){
        return $this->belongsTo(Achievement::class);
    }
}
