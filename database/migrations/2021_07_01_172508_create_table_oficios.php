<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOficios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entidade_id');
            $table->foreign('entidade_id')->references('id')->on('entidades');//->nullable()->default(null);
            $table->unsignedBigInteger('gestao_id');
            $table->foreign('gestao_id')->references('id')->on('gestoes');//->nullable()->default(null);

            $table->string('titulo')->unique();
             $table->string('numeracao');
            $table->string('data');
            $table->string('enderecamento');
            $table->string('assunto');
            $table->longText('corpo');
            $table->string('fecho');
            $table->string('autor');
            $table->string('matricula');
            $table->string('cargo');
            $table->string('hash')->nullable()->defautl(null);
            $table->dateTime('assinado')->nullable();

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
        Schema::dropIfExists('oficios');
    }
}
