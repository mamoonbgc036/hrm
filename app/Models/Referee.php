<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'referee_name',
        'email',
        'referee_organization_id',
        'referee_occupation',
        'referee_contact',
    ];
    public $timestamps = false;
}
