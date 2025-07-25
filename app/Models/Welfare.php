<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Welfare extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function contributions()
    {
        return $this->hasMany(WelfareContribution::class, 'welfare_id', 'id');
    }
}
