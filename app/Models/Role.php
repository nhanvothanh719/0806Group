<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ROLE_ADMIN = 'admin';
    const ROLE_STAFF = 'staff';
    const ROLE_QA_Manager = 'manager';
    const ROLE_QA_Coordinator = 'coordinator';

    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
