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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('email')->unique(); 
            $table->string('password'); 
            $table->string('phone')->nullable(); 
            $table->string('address1'); 
            $table->string('address2')->nullable(); 
            $table->string('city'); 
            $table->string('state'); 
            $table->string('country'); 
            $table->boolean('status')->default('1')->nullable(); 
            $table->string('type'); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};