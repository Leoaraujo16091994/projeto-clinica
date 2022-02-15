<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UltimoPacienteChamado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ultimo_paciente_chamado', function (Blueprint $table) {
            $table->increments('id');         
            $table->integer('paciente_pk')->unsigned();
            $table->foreign('paciente_pk')->references('id')->on('paciente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
