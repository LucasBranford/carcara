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
        Schema::create('patrimonioativo', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("identificacao");
            $table->string("observacao");
            $table->string("obtencao");
            $table->float("custo");
            $table->string("emprestavel");
            $table->string("emprestado")->default("Não");
            $table->string("gremista");
             $table->unsignedBigInteger('entidade_id');
            $table->foreign('entidade_id')->references('id')->on('entidades');
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
        Schema::dropIfExists('table_patrimonioativo');
    }
};
