<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tech_skill extends Model
{
    use HasFactory;
    protected $fillable=["skill_name"];
}
