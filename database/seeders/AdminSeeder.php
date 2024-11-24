<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if a user with the specified email already exists
        $email = 'admin@email.com';
        if (!User::where('email', $email)->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => $email,
                'password' => bcrypt('1234@Abcd'),
                'role' => 'admin',
            ]);
            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->warn('Admin user already exists.');
        }
    }
}
