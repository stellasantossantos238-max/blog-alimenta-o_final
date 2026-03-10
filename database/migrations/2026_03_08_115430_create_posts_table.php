<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained()->onDelete('set null');
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('resumo')->nullable();
            $table->longText('conteudo');
            $table->string('imagem')->nullable();
            $table->enum('tipo', ['normal', 'ai', 'oms'])->default('normal');
            $table->boolean('publicado')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
