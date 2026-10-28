<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entidade_id');
            $table->foreign('entidade_id')->references('id')->on('entidades')->nullable()->default(null);
            $table->string('tipo')->comment('Entrada ou saída');
            $table->string('identificacao')->comment('Identificação da transação (nome, apelido)');
            $table->string('mododepagamento')->comment('Tipo da Transação; Se foi entrada ou saída');
            $table->string('valor')->comment('Valor da Transação em positivo');
            $table->string('participante')->comment('Nome do participante da transação')->nullable();
            $table->string('cpfparticipante')->nullable() ;
            $table->string('gremista')->comment('Usuário que realizou a transação');
            $table->string('cpfgremista')->nullable() ;
            $table->string('comprovante') ;


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
        Schema::dropIfExists('financas');
    }
}
