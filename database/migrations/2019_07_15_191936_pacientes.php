<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class Pacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_completo');
            $table->date('data_nascimento');
            $table->string('convenio_paciente');
            $table->string('soro_positivo');
            $table->string('status_paciente');
            $table->string('segunda_feira');
            $table->string('terca_feira');
            $table->string('quarta_feira');
            $table->string('quinta_feira');
            $table->string('sexta_feira');
            $table->string('sabado');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::drop('pacientes');
    }
}
