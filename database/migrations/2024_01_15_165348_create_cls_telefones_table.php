<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClsTelefonesTable extends Migration
{
    public function up()
    {
        Schema::create('cls_telefones', function (Blueprint $table) {
            $table->id('id_telefone');
            $table->integer('numero_telefone');
            $table->unsignedBigInteger('id_paciente');
            $table->foreign('id_paciente')->references('id_paciente')->on('cls_pacientes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cls_telefones');
    }
}
