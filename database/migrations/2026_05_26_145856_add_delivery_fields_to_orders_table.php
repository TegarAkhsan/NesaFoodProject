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
        Schema::table('orders', function (Blueprint $table) {
            // delivery_type: 'diantar' atau 'diambil'
            $table->string('delivery_type')->default('diambil')->after('address');
            // delivery_fee: 5000 jika diantar, 0 jika diambil
            $table->unsignedInteger('delivery_fee')->default(0)->after('delivery_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['delivery_type', 'delivery_fee']);
        });
    }
};
