<?php

namespace App\Models;

use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableInterface;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model implements ReactableInterface
{
    use HasFactory;
    use Reactable;

    protected $table = "ideas";

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'mission_id',
        'is_anonymous'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function mission(){
        return $this->belongsTo(Mission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments(){
        return $this->hasMany(Attachment::class);
    }
}
