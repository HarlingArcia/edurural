<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_mined')->unique();
            $table->string('nombre_completo');
            $table->integer('edad');
            $table->enum('sexo', ['Masculino', 'Femenino']);
            $table->foreignId('centro_id')->constrained('centros')->onDelete('cascade');
            $table->string('grado');
            $table->string('modalidad');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
};