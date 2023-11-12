<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ipd extends Model
{
    use HasFactory;
    protected $fillable = [

        'id',
        'user_id',
        'department_id',
        'insurance_id',
        'bedgroup_id',
        'bed_id',
        'name',
        'age',
        'dob',
        'pat_gender',
        'cnic',
        'contact_no',
        'date_of_birth',
        'city',
        'guardian_name',
        'guardian_contact',
        'address',
        'image',
        'password',
        'symptom', // Added for symptom names
        'symptom_description', // Added for symptom descriptions
        'reference', // Added for referenc
        'food',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
    public function bedgroup()
    {
        return $this->belongsTo(Bedgroup::class);
    }
    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }
}
