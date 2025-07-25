<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id', 'id');
    }
}
