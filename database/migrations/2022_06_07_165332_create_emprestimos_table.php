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
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("Nome de quem pegou emprestado");

            $table->unsignedBigInteger('patrimonio_id');
            $table->foreign('patrimonio_id')->references('id')->on('patrimonioativo');
            $table->string('matricula')->comment('Matrícula de quem pediu emprestado');
            $table->string('gremista_emprestou')->comment("Gremista que emprestou");
            $table->string('gremista_devolvido')->comment("Gremista a quem foi devolvido")->nullable();
            $table->string('status')->comment("Status do empréstimo (Emprestado ou Encerrado)");
            $table->dateTime('data_devolucao')->comment("Data e hora em que foi devolvido")->nullable();

            
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
        Schema::dropIfExists('emprestimos');
    }
};
