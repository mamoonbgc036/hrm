<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease_hist extends Model
{
    use HasFactory;
    protected $table="disease_hist";
    protected $fillable = [
        'employee_id',
        'disease_id',
        'disease_name',
        'disease_description'
    ];
    public function getDiseaseName(){
        return $this->belongsTo(Disease::class,'disease_id','id');
    }
}
