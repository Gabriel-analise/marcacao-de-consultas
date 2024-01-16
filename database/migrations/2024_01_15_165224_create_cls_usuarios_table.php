<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClsUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('cls_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->string('email', 50);
            $table->string('senha', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cls_usuarios');
    }
}
