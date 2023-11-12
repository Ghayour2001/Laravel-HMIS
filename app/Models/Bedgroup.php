<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bedgroup extends Model
{
    use HasFactory;
    protected $fillable = ['floor_id', 'name', 'description', 'is_active'];
    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }
}
