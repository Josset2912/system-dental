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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('id_paciente');
            $table->string('nombres', 255);
            $table->string('apellidos', 255)->nullable(true);
            $table->string('direccion', 255)->nullable(true);
            $table->string('correo', 255)->nullable(true);
            $table->string('telefono', 255)->nullable(true);
            $table->string('especialidad', 255)->nullable(true);
            $table->dateTime('cita');
            $table->string('alergias', 255)->nullable(true);
            $table->text('observaciones')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
