<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $editorRole = Role::where('slug', 'editor')->first();

        // Create Admin
        User::firstOrCreate(
            ['email' => 'admin@cms.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
                'is_active' => true,
            ]
        );

        // Create Editor
        User::firstOrCreate(
            ['email' => 'editor@cms.com'],
            [
                'name' => 'Editor User',
                'password' => Hash::make('password'),
                'role_id' => $editorRole->id,
                'is_active' => true,
            ]
        );
    }
}

