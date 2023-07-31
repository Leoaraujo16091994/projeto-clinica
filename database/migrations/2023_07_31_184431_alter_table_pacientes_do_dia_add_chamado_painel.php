<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePacientesDoDiaAddChamadoPainel extends Migration
{
     public function up()
    {
        Schema::table('pacientes_do_dia', function (Blueprint $table) {
            $table->integer('chamado_painel')->nullable();
        });
    }

    
    public function down()
    {
        Schema::table('pacientes_do_dia', function (Blueprint $table) {
            $table->dropColumn('chamado_painel');
        });
    }
}
