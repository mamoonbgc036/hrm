<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary_allowance extends Model
{
    use HasFactory;
    protected $table = "salary_allowance";
    protected $fillable = ["salary_template_id", "allowance_label", "allowance_value", "allowance_percent", "allowance_type"];

}
