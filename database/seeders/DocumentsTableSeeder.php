<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Document;


class DocumentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('documents')->insert([
            [
                'title' => 'Document 1',
                'sender_id' => 1, // Assume user with ID 1 exists
                'receiver_id' => 2, // Assume user with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Document 2',
                'sender_id' => 2,
                'receiver_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more documents as needed
        ]);
    }
}

    

