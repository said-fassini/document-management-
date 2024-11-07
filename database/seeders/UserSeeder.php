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
                    'name' => 'President3',
                    'email' => 'president3@gmail.com',
                    'password' => bcrypt('qwerty123456789'),
                    'role' => 'President',
                ]);
        
                User::create([
                    'name' => 'General Director12',
                    'email' => 'director13@gmail.com',
                    'password' => bcrypt('qwerty123456789'),
                    'role' => 'General Director',
                ]);
        
                User::create([
                    'name' => 'Bureau dOrdre3',
                    'email' => 'bureau23@example.com',
                    'password' => bcrypt('qwerty123456789'),
                    'role' => 'Bureau dOrdre',
                ]);
        
                User::create([
                    'name' => 'Service User3',
                    'email' => 'service13@gmail.com',
                    'password' => bcrypt('qwerty123456789'),
                    'role' => 'Service',
                ]);
            
               
            }
        }
        
        // Add more users as needed
    }

