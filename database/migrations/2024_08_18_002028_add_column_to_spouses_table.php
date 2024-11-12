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
        Schema::table('spouses', function (Blueprint $table) {
            $table->string('relationship')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->string('contact')->nullable();
            $table->date('dob')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spouses', function (Blueprint $table) {
            //
        });
    }
};
