<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('hr_id')->unique(); //auto generate unique number for search
            $table->string('achievement_name')->nullable();
            $table->text('memo_no')->nullable();
            $table->date('memo_date')->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('last_updated_by_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('created_by')->nullable();
            $table->string('last_updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievements');
    }
}
