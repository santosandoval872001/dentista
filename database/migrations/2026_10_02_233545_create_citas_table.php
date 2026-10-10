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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('telefono');
            $table->string('email')->nullable();

            $table->date('fecha');
            $table->time('hora');

            $table->string('servicio');

            $table->text('comentarios')->nullable();

            $table->enum('estado', [
                'pendiente',
                'confirmado',
                'cancelado',
                'atendida',
            ])->default('pendiente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
