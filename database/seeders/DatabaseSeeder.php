<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //seed role
        Role::firstOrCreate(['name' => Role::ROLE_ADMIN]);
        Role::firstOrCreate(['name' => Role::ROLE_STAFF]);
        Role::firstOrCreate(['name' => Role::ROLE_QA_Manager]);
        Role::firstOrCreate(['name' => Role::ROLE_QA_Coordinator]);
        //seed department
        Department::firstOrCreate(['name' => Department::SUPPORT]);
        Department::firstOrCreate(['name' => Department::ACADEMIC]);
        //seed core account
        User::create([
            'name' => 'Admin',
            'email' => 'admin@0806.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => 123456789,
            'role_id' => Role::where('name',Role::ROLE_ADMIN)->first()->id
        ]);
        User::create([
            'name' => 'Manager',
            'email' => 'manager@0806.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => 123456789,
            'role_id' => Role::where('name',Role::ROLE_QA_Manager)->first()->id,
        ]);
        
        User::create([
            'name' => 'Support',
            'email' => 'support@0806.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => 123456789,
            'role_id' => Role::where('name',Role::ROLE_QA_Coordinator)->first()->id,
            'department_id' => Department::where('name',Department::SUPPORT)->first()->id,
        ]);
        
        User::create([
            'name' => 'Academic',
            'email' => 'academic@0806.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => 123456789,
            'role_id' => Role::where('name',Role::ROLE_QA_Coordinator)->first()->id,
            'department_id' => Department::where('name',Department::ACADEMIC)->first()->id,
        ]);
        //seed staff
        User::factory(10)->create();
    }
}
