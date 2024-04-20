<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 
        'building_id',
        'is_enabled',
    ];

    public function visitClassroom(){
        return $this->hasMany(Visit::class, 'classroom_id');
    }

    public function building(){
        return $this->belongsTo(Building::class, 'building_id');
    }
}
