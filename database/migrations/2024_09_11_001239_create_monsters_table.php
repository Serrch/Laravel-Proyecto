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
        Schema::create('monsters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('category');
            $table->string('ubication');
            $table->string('wk_elemental');
            $table->string('wk_estate');
            $table->string('img_monster');
            $table->string('img_logo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monsters');
    }
};
