<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'end_day'
    ];
    
    protected $dates = [
        'end_day'
    ];

    
    public function missions()
    {
        return $this->hasMany(Mission::class);
    }
}
