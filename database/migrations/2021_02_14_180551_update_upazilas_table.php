<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUpazilasTable extends Migration
{
    public function up()
    {
        Schema::table('upazilas', function (Blueprint $table) {
            $table->foreignId('created_by')->default(1)->after('url')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->default(1)->after('created_by')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('upazilas', function (Blueprint $table) {
            $table->dropColumn(['created_by','updated_by','deleted_at']);
        });
    }
}
