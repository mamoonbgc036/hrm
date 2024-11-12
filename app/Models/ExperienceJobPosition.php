<?php

namespace App\Models;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExperienceJobPosition extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function experience(){
        return $this->hasMany(Experience::class, 'job_position', 'id');
    }
}
