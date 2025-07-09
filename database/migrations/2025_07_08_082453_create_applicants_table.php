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

            // Application status with all possible values
            $table->enum('status', ['applied', 'interview', 'rejected'])
                  ->default('applied');

            // Additional application fields
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('experience')->nullable();
            $table->text('education')->nullable();
            $table->string('skills')->nullable();
            $table->text('cover_letter')->nullable();
            $table->string('resume')->nullable();
            $table->timestamp('applied_at')->nullable();

            // Additional fields that might be added from application form
            $table->string('portfolio_url')->nullable();
            $table->string('expected_salary')->nullable();
            $table->date('availability_date')->nullable();

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
