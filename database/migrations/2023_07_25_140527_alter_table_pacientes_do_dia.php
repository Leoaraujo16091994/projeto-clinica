<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePacientesDoDia extends Migration
{
    public function up()
    {
        Schema::table('pacientes_do_dia', function (Blueprint $table) {
            $table->integer('chamar_acompanhante')->nullable();
        });
    }

    
    public function down()
    {
        Schema::table('pacientes_do_dia', function (Blueprint $table) {
            $table->dropColumn('chamar_acompanhante');
        });
    }
}
