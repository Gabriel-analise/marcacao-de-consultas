<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClsConsultasTable extends Migration
{
    public function up()
    {
        Schema::create('cls_consultas', function (Blueprint $table) {
            $table->id('id_consulta');
            $table->unsignedBigInteger('paciente');
            $table->foreign('paciente')->references('id_paciente')->on('cls_pacientes');
            $table->unsignedBigInteger('medico');
            $table->foreign('medico')->references('id_medico')->on('cls_medicos');
            $table->dateTime('data_consulta');
            $table->dateTime('data_agendamento');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cls_consultas');
    }
}
