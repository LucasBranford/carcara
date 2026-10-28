
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
        Schema::create('atas', function (Blueprint $table) {
            $table->id();
            $table->string('numeracao');
             $table->string('titulo');
             $table->string('temporalidade');
            $table->string('convocacao');
            $table->string('secretaria');
            $table->string('tipo');
            $table->string('data_reuniao');
            $table->string('horario_reuniao');
            $table->string('local');
            $table->mediumText('pautas');
            $table->mediumText('encaminhamentos');
            $table->mediumText('presentes');
            $table->mediumText('corpo');
            $table->string('autor');
            $table->string('orgao');
            $table->string('cargo');
            $table->string('matricula');
            $table->string('hash')->nullable();
            $table->dateTime('assinado')->nullable();
            $table->unsignedBigInteger('entidade_id');
            $table->foreign("entidade_id")->references('id')->on("entidades");
            $table->unsignedBigInteger('gestao_id');

            $table->foreign("gestao_id")->references('id')->on("gestoes");
            $table->timestamps();


    });}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atas');
    }
};
