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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liker_id');
            $table->unsignedBigInteger('liked_id');
            $table->timestamps();

            $table->unique(['liker_id', 'liked_id']);

            $table->foreign('liker_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('liked_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
