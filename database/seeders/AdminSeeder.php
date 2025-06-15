<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@byread.com',
            'email_verified' => true,
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'membership' => 'premium',
            'membership_expires_at' => now()->addYears(10),
            'bio' => 'Rasya',
            'online_status' => true,
            'last_seen' => now(),
        ]);
    }
} 