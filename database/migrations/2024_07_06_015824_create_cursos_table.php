<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 255);
            $table->decimal('precio', 8, 2);
            $table->text('descripcion');
            $table->integer('duracion');
            $table->string('imagen', 255)->nullable();
            $table->tinyInteger('disponible')->default(1);
            $table->string('instructor')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
