<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bedtype extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function beds()
    {
        return $this->hasMany(Bed::class);
    }
}
