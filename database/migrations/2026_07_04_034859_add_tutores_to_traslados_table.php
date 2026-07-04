<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('traslados', function (Blueprint $table) {
            $table->string('sexo')->nullable()->after('motivo');
            $table->integer('edad_estudiante')->nullable()->after('sexo');
            $table->string('grado_estudiante')->nullable()->after('edad_estudiante');
            $table->string('nombre_tutor')->nullable()->after('grado_estudiante');
            $table->string('cedula_tutor')->unique()->nullable()->after('nombre_tutor');
        });
    }

    public function down()
    {
        Schema::table('traslados', function (Blueprint $table) {
            $table->dropColumn(['sexo', 'edad_estudiante', 'grado_estudiante', 'nombre_tutor', 'cedula_tutor']);
        });
    }
};