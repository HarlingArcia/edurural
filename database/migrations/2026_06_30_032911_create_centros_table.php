<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('centros', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique(); // Ej: C-01
            $table->string('nombre');
            $table->integer('maestros');
            $table->enum('estado', ['Sincronizado', 'Pendiente'])->default('Sincronizado');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('centros');
    }
};