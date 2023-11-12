<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_id',
        'employee_name',
        'father_name',
        'email',
        'dob',
        'cnic',
        'contact_no',
        'position',
        'qualification',
        'probation_period',
        'address',
        'image'
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
