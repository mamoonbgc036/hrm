<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id', 
        'relationship', 
        'relation_name', 
        'relation_occupation', 
        'relation_contact', 
        'relation_dob',
    ];
    public $timestamps=false;

}
