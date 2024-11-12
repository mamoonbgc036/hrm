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
        Schema::create('disease_hist', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('employee_id');
            $table->integer('disease_id')->nullable();
            // $table->string('disease_name')->nullable(); 
            $table->text('disease_description')->nullable(); 
            $table->timestamps(); 
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
