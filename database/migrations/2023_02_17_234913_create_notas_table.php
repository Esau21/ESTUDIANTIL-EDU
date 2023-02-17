<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('nota1');
            $table->decimal('nota2');
            $table->decimal('nota3');
            $table->decimal('nota4');
            $table->decimal('promedio');
            $table->integer('estudiante_id')->unsigned();
            $table->integer('profesor_id')->unsigned();
            $table->integer('materia_id')->unsigned();
            $table->integer('carrera_id')->unsigned();
            $table->timestamps();


            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreign('profesor_id')->references('id')->on('profesors');
            $table->foreign('materia_id')->references('id')->on('materias');
            $table->foreign('carrera_id')->references('id')->on('carreras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas');
    }
}
