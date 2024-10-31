<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // Drop file_path column if exists
            $table->dropColumn('file_path');
            
            // Add new file_data column as binary
            $table->binary('file_data')->nullable();
            $table->string('status')->default('pending'); // Document status

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // Add file_path back in case of rollback
            $table->string('file_path')->nullable();

            // Remove file_data column
            $table->dropColumn('file_data');
        });
    }
};
