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
        Schema::create('applicants', function (Blueprint $table) {
    $table->id();

    $table->foreignId('work_id')->constrained()->onDelete('cascade');

    $table->foreignId('applicant_id')
          ->constrained('users')
          ->onDelete('cascade');

    $table->foreignId('company_id')
          ->constrained('users')
          ->onDelete('cascade');

    $table->enum('status', ['applied', 'interviewed', 'hired', 'rejected'])->default('applied');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
