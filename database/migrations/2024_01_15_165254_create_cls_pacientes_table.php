<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClsPacientesTable extends Migration
{
    public function up()
    {
        Schema::create('cls_pacientes', function (Blueprint $table) {
            $table->id('id_paciente');
            $table->string('nome_paciente', 50);
            $table->string('cpf_paciente', 11)->unique();
            $table->dateTime('data_cadastro');
            $table->string('email_paciente', 50);
            $table->string('cep_paciente', 8)->nullable();
            $table->string('endereco_paciente', 50);
            $table->integer('numero_paciente');
            $table->string('nome_responsavel', 50)->nullable();
            $table->string('cpf_responsavel', 11)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cls_pacientes');
    }
}
