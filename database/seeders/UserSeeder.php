<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@admin.admin',
            'password' => 'adminadmin',
            'nip' => '123456789',
            'position' => 'Administrator',
            'department' => 'IT Department',
            'role' => 'admin',
            'is_active' => true,
        ]);
    }
}