<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('stand_owners', function (Blueprint $table) {
            $table->string('stand_name')->after('password'); // sesuaikan posisi kolom
        });
    }

    public function down()
    {
        Schema::table('stand_owners', function (Blueprint $table) {
            $table->dropColumn('stand_name');
        });
    }

};
