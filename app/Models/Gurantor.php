<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gurantor extends Model
{
    use HasFactory;
    protected $table = "guarantors";

    protected $fillable = [
        'gurantor_name',
        'gurantor_occupation',
        'images',
        'signature',
        'relations',
        'gurantor_contact',
        'gurantor_organization_id',
        'employee_id'
    ];
    public $timestamps = false;

}
