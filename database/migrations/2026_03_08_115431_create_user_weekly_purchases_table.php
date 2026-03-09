<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_weekly_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade');
            $table->float('quantidade_gramas');
            $table->date('semana_inicio');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_weekly_purchases');
    }
};
