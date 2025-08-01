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
        Schema::create('interviews', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id'); // Candidate ID
    $table->unsignedBigInteger('company_id'); // Recruiter ID or company
    $table->dateTime('scheduled_at');
    $table->string('meet_link')->nullable();
    $table->enum('status', ['pending', 'live', 'completed'])->default('pending');
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
