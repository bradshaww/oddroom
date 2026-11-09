<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('studio_images', function (Blueprint $table) {
            $table->id('studio_image_id');

            $table->unsignedBigInteger('studio_id');

            $table->string('image_path');

            $table->timestamps();

            $table->foreign('studio_id')
                ->references('studio_id')
                ->on('studios')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('studio_images');
    }
};