<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PunishmentEmployee extends Pivot
{
    protected $table = 'employee_punishments';

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function punishment(){
        return $this->belongsTo(Punishment::class);
    }
}
