<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        \App\Models\User::factory(20)->create();

        // Admin user
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'birthyear' => '2023',
            'gender' => 0,
            'admin' => 1
        ]);

        // Fix normal user
        \App\Models\User::factory()->create([
            'name' => 'Nagy Béla',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('user'),
            'birthyear' => '1990',
            'gender' => 0,
            'admin' => 0
        ]);
    }
}
