<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oms_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_category_id')->constrained()->onDelete('cascade');
            $table->float('quantidade_diaria_gramas');
            $table->string('unidade')->default('g');
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oms_recommendations');
    }
};
