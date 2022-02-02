<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PacientesDoDia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_do_dia', function (Blueprint $table) {
            $table->increments('id');         
            $table->integer('paciente_pk')->unsigned();
            $table->foreign('paciente_pk')->references('id')->on('paciente');
            $table->integer('chegou');
            $table->integer('chamado');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::drop('pacientes_do_dia');
    }




}
