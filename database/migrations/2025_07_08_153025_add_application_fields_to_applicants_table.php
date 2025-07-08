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
        Schema::table('applicants', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('experience')->nullable();
            $table->text('education')->nullable();
            $table->string('skills')->nullable();
            $table->text('cover_letter')->nullable();
            $table->string('resume')->nullable();
            $table->timestamp('applied_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'address', 
                'experience',
                'education',
                'skills',
                'cover_letter',
                'resume',
                'applied_at'
            ]);
        });
    }
};
