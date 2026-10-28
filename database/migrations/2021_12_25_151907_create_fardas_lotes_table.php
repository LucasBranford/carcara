<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFardasLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fardas_lotes', function (Blueprint $table) {
            $table->id();
            $table->boolean("vigente")->comment("Verdadeiro para lote que está vigente");

            $table->string("fornecedor_nome");
            $table->string("fornecedor_telefone");
            $table->date("recebimento");
            $table->integer("preco_fornecedor");
            $table->integer("lucro_entidade")->comment("Este campo será adicionado ao campo preco_fornecedor para gerar o valor total da farda no campo preco_farda");
            $table->integer("preco_farda");

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
        Schema::dropIfExists('fardas_lotes');
    }
}
