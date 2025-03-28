<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stand_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->enum('type', ['makanan', 'minuman']);
            $table->text('description')->nullable();
            $table->string('image')->default('default.jpg'); // Tambahkan kolom image dengan nilai default
            $table->timestamps();
        });
    }
    
};
