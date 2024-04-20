<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'career_id',
        'email',
        'arrival_time',
        'leaving_time',
        'building_id',
        'classroom_id',
        'visit_reason'
    ];

    public function career(){
        return $this->belongsTo(Career::class, 'career_id');
    }
    
}
