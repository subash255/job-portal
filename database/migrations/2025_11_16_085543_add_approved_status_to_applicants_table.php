<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            // Modify the status enum to include 'approved'
            DB::statement("ALTER TABLE applicants MODIFY COLUMN status ENUM('applied', 'interview', 'rejected', 'approved') DEFAULT 'applied'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            // Revert back to original enum values
            DB::statement("ALTER TABLE applicants MODIFY COLUMN status ENUM('applied', 'interview', 'rejected') DEFAULT 'applied'");
        });
    }
};
