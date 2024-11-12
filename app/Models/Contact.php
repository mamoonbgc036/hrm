<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'e_contact_person_name',
        'e_contact_person_number',
        'e_contact_person_relation',
        'e_contact_person_email',
        'e_contact_person_address',
    ];

    public function contactRelationship()
    {
        return $this->hasOne(Relationship::class, 'id', 'e_contact_person_relation');
    }
}
