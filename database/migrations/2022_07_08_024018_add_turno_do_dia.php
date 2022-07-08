<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTurnoDoDia extends Migration
{
    
    public function up()
    {
        Schema::table('pacientes_do_dia', function (Blueprint $table) {
            $table->integer('turno_do_dia')->nullable();
        });
    }

    
    public function down()
    {
        Schema::table('pacientes_do_dia', function (Blueprint $table) {
            $table->dropColumn('turno_do_dia');
            
        });
    }
}
