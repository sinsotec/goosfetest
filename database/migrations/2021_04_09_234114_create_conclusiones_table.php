<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConclusionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conclusiones', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cuestionario_id')->require;
            $table->string('conclusion')->require;
            $table->unsignedInteger('puntuacion_min')->require;
            $table->string('idioma_id')->default('es');
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
        Schema::dropIfExists('conclusiones');
    }
}
