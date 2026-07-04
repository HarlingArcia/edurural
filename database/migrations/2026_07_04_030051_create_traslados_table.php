<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('traslados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiante_id')->constrained('estudiantes')->onDelete('cascade');
            $table->foreignId('centro_origen_id')->constrained('centros')->onDelete('cascade');
            $table->foreignId('centro_destino_id')->constrained('centros')->onDelete('cascade');
            $table->date('fecha_traslado');
            $table->string('motivo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('traslados');
    }
};