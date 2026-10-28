<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votacoes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->mediumText('descricao');
            $table->string('gremista')->comment('Gremista que criou a votação');
            $table->dateTime('inicio')->comment('Data e hora de início da votação');
            $table->dateTime('termino')->comment('Data e hora de término da votação');
            $table->dateTime('inicio_validacao')->comment('Data e hora de início da validação');
            $table->dateTime('termino_validacao')->comment('Data e hora de término da validação');

            $table->unsignedBigInteger("user_id");


            $table->foreign('user_id')->references('id')->on('users');
            $table->string('status')->default("Ativa");
            $table->string('codigo')->unique();

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
        Schema::dropIfExists('votacoes');
    }
};
