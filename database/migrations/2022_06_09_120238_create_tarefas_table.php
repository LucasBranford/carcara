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
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("Nome da tarefa");
            $table->unsignedBigInteger("user_id")->comment("Usuário que criou a tarefa");
            $table->foreign("user_id")->references("id")->on("users");
            $table->unsignedBigInteger("responsavel")->comment("Usuário responsável");
            $table->foreign("responsavel")->references("id")->on("users");
            $table->unsignedBigInteger("entidade_id")->comment("Entidade a qual a tarefa será vinculada");
            $table->foreign("entidade_id")->references("id")->on("entidades");
            $table->integer("coluna")->comment("Coluna em que está inserido (A fazer, em progresso ou Concluído");  
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
        Schema::dropIfExists('tarefas');
    }
};
