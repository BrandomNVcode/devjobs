<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // primero creamos categorias, experiencias, salarios y ubicacions para poder crear vacantes
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('experiencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('ubicacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('salarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });



        // vacantes requiere de categorias, experiencias, salarios y ubicacions para crearse por el foreingn id que los relaciona
        Schema::create('vacantes', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
            $table->foreignId('experiencia_id')->constrained()->onDelete('cascade');
            $table->foreignId('ubicacion_id')->constrained()->onDelete('cascade');
            $table->foreignId('salario_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Como categorias y experiencias esta relacionado con vacantes, primero se elimina las vacantes
        Schema::dropIfExists('vacantes');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('experiencias');
        Schema::dropIfExists('ubicacions');
        Schema::dropIfExists('salarios');
    }
}
