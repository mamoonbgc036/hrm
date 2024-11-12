<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HourRate extends Model
{
    use HasFactory;

    protected $fillable = ['grade', 'basic_salary'];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'grade_id', 'id');
    }

    public function getHourlyRateAttribute()
    {
        return $this->basic_salary . ' tk(Hourly)';
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
