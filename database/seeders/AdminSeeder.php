<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@abidcms.com',  // You can change this
            'password' => Hash::make('12345678'),  // You can change this
            'role' => 'admin',
        ]);
    }
}