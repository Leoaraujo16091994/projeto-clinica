<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Paciente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_completo');
            $table->integer('dias_semana');
            $table->integer('turno');
            $table->integer('sala');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::drop('paciente');
    }
}
