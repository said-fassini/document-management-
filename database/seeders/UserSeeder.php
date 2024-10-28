<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
           {
                User::create([
                    'name' => 'President',
                    'email' => 'president21@gmail.com',
                    'password' => bcrypt('qwerty123456789'),
                    'role' => 'President',
                ]);
        
                User::create([
                    'name' => 'General Director',
                    'email' => 'director12@gmail.com',
                    'password' => bcrypt('qwerty123456789'),
                    'role' => 'General Director',
                ]);
        
                User::create([
                    'name' => 'Bureau dOrdre',
                    'email' => 'bureau53@example.com',
                    'password' => bcrypt('qwerty123456789'),
                    'role' => 'Bureau dOrdre',
                ]);
        
                User::create([
                    'name' => 'Service User',
                    'email' => 'servic51e@gmail.com',
                    'password' => bcrypt('qwerty123456789'),
                    'role' => 'Service',
                ]);
            }
        }
        
        // Add more users as needed
    }

