<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $table = "attachments";

    protected $fillable = [
        'name',
        'direction',
        'idea_id'
    ];

    public function idea(){
        return $this->belongsTo(Idea::class);
    }
}
