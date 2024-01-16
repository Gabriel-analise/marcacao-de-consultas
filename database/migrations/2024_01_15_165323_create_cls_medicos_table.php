<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClsMedicosTable extends Migration
{
    public function up()
    {
        Schema::create('cls_medicos', function (Blueprint $table) {
            $table->id('id_medico');
            $table->string('nome_medico', 50);
            $table->unsignedBigInteger('especialidade_medico');
            $table->foreign('especialidade_medico')->references('id_especialidade')->on('cls_especialidades');
            $table->string('CRM_medico', 8);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cls_medicos');
    }
}
