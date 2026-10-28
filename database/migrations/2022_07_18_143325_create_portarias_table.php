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
        Schema::create('portarias', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->string("numeracao");
            $table->string("resumo");
            $table->mediumText("corpo");
            $table->string("autor");
            $table->string("matricula");
            $table->string("cargo");
            $table->unsignedBigInteger("entidade_id");
            $table->foreign("entidade_id")->references('id')->on("entidades");
            $table->unsignedBigInteger("gestao_id");
            $table->foreign("gestao_id")->references('id')->on("gestoes");
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
        Schema::dropIfExists('portarias');
    }
};
