<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Alarga o enum para aceitar todos os valores ao mesmo tempo
        DB::statement("ALTER TABLE posts MODIFY COLUMN tipo ENUM('normal','ai','oms','noticia','sugestao','alimentacao_saudavel') NOT NULL DEFAULT 'normal'");

        // 2. Converte os valores antigos
        DB::table('posts')->where('tipo', 'normal')->update(['tipo' => 'noticia']);
        DB::table('posts')->where('tipo', 'ai')->update(['tipo' => 'noticia']);
        DB::table('posts')->where('tipo', 'oms')->update(['tipo' => 'alimentacao_saudavel']);

        // 3. Remove os valores antigos do enum
        DB::statement("ALTER TABLE posts MODIFY COLUMN tipo ENUM('noticia','sugestao','alimentacao_saudavel') NOT NULL DEFAULT 'noticia'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE posts MODIFY COLUMN tipo ENUM('noticia','sugestao','alimentacao_saudavel','normal','ai','oms') NOT NULL DEFAULT 'noticia'");
        DB::table('posts')->where('tipo', 'noticia')->update(['tipo' => 'normal']);
        DB::table('posts')->where('tipo', 'alimentacao_saudavel')->update(['tipo' => 'oms']);
        DB::statement("ALTER TABLE posts MODIFY COLUMN tipo ENUM('normal','ai','oms') NOT NULL DEFAULT 'normal'");
    }
};
