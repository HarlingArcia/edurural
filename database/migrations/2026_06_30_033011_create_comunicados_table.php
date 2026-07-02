<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comunicados', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // MINED, Circular, Reunión
            $table->string('titulo');
            $table->text('texto');
            $table->date('fecha_publicacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comunicados');
    }
};