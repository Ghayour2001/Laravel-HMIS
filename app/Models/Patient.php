<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','insurance_id', 'reference','department_id', 'name', 'type', 'age', 'dob', 'pat_gender', 'cnic', 'contact_no', 'date_of_birth', 'city', 'guardian_name', 'guardian_contact', 'address', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class,);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
      public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
}
