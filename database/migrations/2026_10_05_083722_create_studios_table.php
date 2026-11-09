<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void //apa yg dilakuin pas migraion dijalanin -melda
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->id('studio_id');
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->decimal('price_per_hour', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void //batalin migration 
    {
        Schema::dropIfExists('studios');
    }
};
