<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClsEspecialidadesTable extends Migration
{
    public function up()
    {
        Schema::create('cls_especialidades', function (Blueprint $table) {
            $table->id('id_especialidade');
            $table->string('nome_especialidade', 50)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cls_especialidades');
    }
}
