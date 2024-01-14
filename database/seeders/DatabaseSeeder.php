<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        User::factory(10)->create();

        // Admin user
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'birthyear' => '2023',
            'gender' => 0,
            'admin' => 1
        ]);

        // Fix normal user
        User::factory()->create([
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
