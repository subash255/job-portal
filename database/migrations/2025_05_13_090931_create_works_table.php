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
        Schema::create('works', function (Blueprint $table) {
             $table->id();
            $table->string('title');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullsable();
            $table->string('slug')->unique();  
            $table->string('position')->nullable();
            $table->text('description')->nullable();
            $table->text('responsibility')->nullable();
            $table->text('benefits')->nullable();
            $table->string('image')->nullable(); 
            $table->string('company_name'); 
            $table->date('start_date'); 
            $table->date('end_date')->nullable(); 
            $table->string('location');
            $table->string('salary')->nullable();
            $table->string('type')->default('full-time');
            $table->string('status')->default('active');
            $table->text('expected_requirement')->nullable();
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
