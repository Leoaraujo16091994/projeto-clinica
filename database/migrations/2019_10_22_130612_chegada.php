<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Chegada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chegada', function (Blueprint $table) {
            $table->string('nome_completo');
            $table->timestamps();
        });
    }




    public function down()
    {
        Schema::drop('chegada');
    }
}

