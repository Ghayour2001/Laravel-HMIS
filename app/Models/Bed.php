<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'bedtype_id', 'bedgroup_id'];
    public function bedtype(){
        return $this->belongsTo(Bedtype::class);
    } public function bedgroup(){
        return $this->belongsTo(Bedgroup::class);
    }
}
