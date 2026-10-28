<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGestoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestoes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('entidade_id');
            $table->foreign('entidade_id')->references('id')->on('entidades');
            $table->string('ativa')->default('Sim')->comment("Se a gestão está ativa ou não");
            $table->date('inicio');
            $table->date('termino')->nullable()->default(null);
            $table->string('atadeposse');
            $table->string('provisoria')->default('Não');


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
        Schema::dropIfExists('gestoes');
    }
}
