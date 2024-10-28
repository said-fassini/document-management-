<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Document;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the President user
        User::factory()->create([
            'name' => 'President',
            'email' => 'president@gmail.com',
            'password' => bcrypt('qwerty123456789'),
            'role' => 'President',
        ]);

        // Create other users with specified roles
        User::factory()->create([
            'name' => 'General Director',
            'email' => 'director@gmail.com',
            'password' => bcrypt('qwerty123456789'),
            'role' => 'General Director',
        ]);

        User::factory()->create([
            'name' => 'Bureau dOrdre',
            'email' => 'bureau@example.com',
            'password' => bcrypt('qwerty123456789'),
            'role' => 'Bureau dOrdre',
        ]);

        User::factory()->create([
            'name' => 'Service User',
            'email' => 'service@gmail.com',
            'password' => bcrypt('qwerty123456789'),
            'role' => 'Service',
        ]);

        // You can create more users or use a loop if necessary.
        $this->call([
            DocumentsTableSeeder::class,
            // Other seeders...
        ]);
    }
}
