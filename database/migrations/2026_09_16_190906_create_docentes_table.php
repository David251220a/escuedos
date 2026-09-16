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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entidad_id')->constrained()->restrictOnDelete();
            $table->foreignId('user_id')->nullable()->unique()->constrained()->nullOnDelete();
            $table->string('documento', 30)->nullable()->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('email')->nullable();
            $table->string('celular', 30)->nullable();
            $table->string('direccion')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('mostrar_principal')->default(false);
            $table->unsignedInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
