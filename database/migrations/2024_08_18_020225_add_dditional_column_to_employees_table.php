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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('e_contact_person_email')->nullable();
            $table->string('e_contact_person_address')->nullable();
            $table->unsignedBigInteger('disease_id')->nullable();

            $table->foreign('disease_id')->references('id')->on('diseases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
};
