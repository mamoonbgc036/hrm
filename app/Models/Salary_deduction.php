<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary_deduction extends Model
{
    use HasFactory;
    protected $table = "salary_deduction";
    protected $fillable = ["salary_template_id", "deduction_label", "deduction_value", "type", 'deduct_amount'];
}
