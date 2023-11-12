<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization_name',
        'contact_no',
        'email',
        'limit',
        'from_date',
        'to_date',
        'contact_person_name',
        'contact_person_phone',
        'position',
        'address'
    ];

}
