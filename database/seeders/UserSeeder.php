<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'       => 'Administrator',
            'username'   => 'admin',
            'email'      => 'admin@admin.com',
            'password'   => Hash::make('password'),
            'nip'        => '199001010001',
            'position'   => 'System Administrator',
            'department' => 'Information Technology',
            'role'       => 'admin',
            'is_active'  => true,
        ]);

        // Staff
        User::create([
            'name'       => 'Staff Dokumen',
            'username'   => 'staff01',
            'email'      => 'staff@govdocs.test',
            'password'   => Hash::make('password'),
            'nip'        => '199001010002',
            'position'   => 'Staf Pengelola Dokumen',
            'department' => 'Bagian Umum',
            'role'       => 'staff',
            'is_active'  => true,
        ]);

        // Viewer
        User::create([
            'name'       => 'Pengguna Viewer',
            'username'   => 'viewer01',
            'email'      => 'viewer@govdocs.test',
            'password'   => Hash::make('password'),
            'nip'        => '199001010003',
            'position'   => 'Kepala Bidang',
            'department' => 'Bidang Perencanaan',
            'role'       => 'viewer',
            'is_active'  => true,
        ]);
    }
}