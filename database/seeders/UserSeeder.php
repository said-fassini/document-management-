<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create the President user
        User::create([
            'name' => 'President',
            'email' => 'president@gmail.com',
            'password' => bcrypt('qwerty123456789'), // Use a secure password
            'role' => 'President',
        ]);

        // Create the General Director user
        User::create([
            'name' => 'General Director',
            'email' => 'director@gmail.com',
            'password' => bcrypt('qwerty123456789'), // Use a secure password
            'role' => 'General Director',
        ]);

        // Create the Bureau d'Ordre user
        User::create([
            'name' => 'Bureau dOrdre',
            'email' => 'bureau@example.com',
            'password' => bcrypt('qwerty123456789'), // Use a secure password
            'role' => 'Bureau dOrdre',
        ]);

        // Create the Service user
        User::create([
            'name' => 'Service User',
            'email' => 'service@gmail.com',
            'password' => bcrypt('qwerty123456789'), // Use a secure password
            'role' => 'Service',
        ]);

        // Add more users as needed
    }
}
