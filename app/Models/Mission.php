<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $table = "missions";

    protected $fillable = [
        'name',
        'description',
        'end_at',
        'semester_id',
    ];

    protected $dates = [
        'end_at'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }
}
