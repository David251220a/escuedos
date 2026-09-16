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
        Schema::create('entidads', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('lema')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('mision')->nullable();
            $table->text('vision')->nullable();
            $table->string('email')->nullable();
            $table->string('celular', 30)->nullable();
            $table->string('whatsapp', 30)->nullable();
            $table->string('direccion')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('x_url')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('sitio_web')->nullable();
            $table->text('mapa_url')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('imagen_portada')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entidads');
    }
};
