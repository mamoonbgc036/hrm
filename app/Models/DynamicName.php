<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicName extends Model
{
    use HasFactory;

    protected $fillable = ['company_name', 'software_name'];
}
