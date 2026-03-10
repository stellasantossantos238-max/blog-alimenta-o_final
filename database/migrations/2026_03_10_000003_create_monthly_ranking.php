<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_monthly_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('mes_ano', 7);
            $table->float('score')->default(0);
            $table->integer('posicao')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'mes_ano']);
        });

        Schema::table('user_weekly_purchases', function (Blueprint $table) {
            $table->string('mes_ano', 7)->nullable()->after('semana_inicio');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_monthly_scores');
        Schema::table('user_weekly_purchases', function (Blueprint $table) {
            $table->dropColumn('mes_ano');
        });
    }
};
