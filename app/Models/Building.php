<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{

    public $timestamps = false;

    public $fillable = [
        'name',
        'is_enabled'
    ];

    use HasFactory;

    public function buildingClassroom(){
        return $this->hasMany(Classroom::class, 'building_id');
    }

    public function visitBuilding(){
        return $this->hasMany(Visit::class, 'building_id');
    }
}
