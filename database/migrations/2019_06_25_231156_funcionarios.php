<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Funcionarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->string('nome_completo');
            $table->string('cargo');
            $table->string('id');
            $table->string('senha');

        });
    }




    public function down()
    {
        Schema::drop('funcionarios');
    }
}
