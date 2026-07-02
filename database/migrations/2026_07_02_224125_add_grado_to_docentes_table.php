<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('docentes', function (Blueprint $table) {
            // Agrega la columna 'grado' justo después de 'especialidad'
            $table->string('grado')->nullable()->after('especialidad');
        });
    }

    public function down()
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->dropColumn('grado');
        });
    }
};