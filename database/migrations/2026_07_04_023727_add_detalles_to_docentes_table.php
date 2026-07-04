<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->string('cedula')->unique()->after('nombre_completo');
            $table->integer('edad')->nullable()->after('cedula');
            $table->string('telefono')->nullable()->after('edad');
            $table->string('lugar')->nullable()->after('telefono');
            $table->string('gmail')->nullable()->after('lugar');
            
            // Ya no intentamos crear 'grado' aquí porque tu migración anterior ya lo hace.
            
            $table->string('experiencia_laboral')->nullable()->after('especialidad');
        });
    }

    public function down()
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->dropColumn(['cedula', 'edad', 'telefono', 'lugar', 'gmail', 'experiencia_laboral']);
        });
    }
};