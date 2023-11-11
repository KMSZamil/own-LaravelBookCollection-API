<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'user_type' => '1',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Librarian',
            'email' => 'librarian@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'user_type' => '2',
            'remember_token' => Str::random(10),
        ]);

        User::factory()
            ->count(50)
            ->create();
    }
}
