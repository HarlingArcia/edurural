<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiante_id')->constrained('estudiantes')->onDelete('cascade');
            $table->integer('parcial'); // 1, 2, 3 o 4
            $table->decimal('matematicas', 5, 2)->nullable();
            $table->decimal('lengua_literatura', 5, 2)->nullable();
            $table->decimal('ciencias_naturales', 5, 2)->nullable();
            $table->decimal('valores', 5, 2)->nullable();
            $table->decimal('dignidad_mujer', 5, 2)->nullable();
            $table->decimal('quimica', 5, 2)->nullable();
            $table->decimal('fisica', 5, 2)->nullable();
            $table->decimal('aep', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calificaciones');
    }
};