<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     AdminSeeder::class,
        // ]);

        // // Your existing seed code can stay
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        for ($i = 0; $i < 1000; $i++) {
            $data = \App\Models\User::factory()->make()->toArray();
            $data['password'] = bcrypt('password'); // Add password here


            User::firstOrCreate(
                ['email' => $data['email']], // Check for duplicate email
                $data // If not found, use this data to create a new user
            );
        }
    }
}