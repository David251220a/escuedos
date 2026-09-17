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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('resumen')->nullable();
            $table->longText('contenido');
            $table->dateTime('fecha_evento')->nullable();
            $table->string('imagen')->nullable();
            $table->boolean('mostrar_carrusel')->default(false);
            $table->unsignedInteger('orden_carrusel')->default(0);
            $table->string('estado', 20)->default('BORRADOR');
            $table->string('tipo_presentacion', 30)->default('NORMAL');
            $table->dateTime('fecha_publicacion')->nullable();
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
