<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);

        \App\Models\Event::create([
            'title' => 'Laravel Livewire 101',
            'speaker' => 'Taylor Otwell',
            'location' => 'Room A',
            'total_seats' => 50,
        ]);

        \App\Models\Event::create([
            'title' => 'Advanced Database Design',
            'speaker' => 'Jane Doe',
            'location' => 'Room B',
            'total_seats' => 30,
        ]);

        \App\Models\Event::create([
            'title' => 'Building Secure APIs',
            'speaker' => 'John Smith',
            'location' => 'Room C',
            'total_seats' => 20,
        ]);

        \App\Models\Event::create([
            'title' => 'Small Private Workshop',
            'speaker' => 'Alice Johnson',
            'location' => 'Room D',
            'total_seats' => 1, // Useful for testing the "Full seats" constraint
        ]);
    }
}
