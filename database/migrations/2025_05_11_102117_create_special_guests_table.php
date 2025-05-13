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
        Schema::create('special_guests', function (Blueprint $table) {
            $table->id();
            $table->enum('title', ['dr', 'prof', 'mr', 'mme']);
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('domain')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_guests');
    }
};
