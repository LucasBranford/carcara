<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCargos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
         
            $table->unsignedBigInteger('diretoria_id');
            $table->foreign('diretoria_id')->references('id')->on('diretorias');

            $table->boolean('regif')->default(true);
            $table->boolean('gedm')->default(true);
            $table->boolean('gevp')->default(true);
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
        Schema::dropIfExists('cargos');
    }
}
