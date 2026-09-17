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
        Schema::create('noticia_imagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('noticia_id')->constrained()->cascadeOnDelete();
            $table->string('imagen');
            $table->string('titulo')->nullable();
            $table->string('texto_alternativo')->nullable();
            $table->unsignedInteger('orden')->default(0);
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticia_imagens');
    }
};
