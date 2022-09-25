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
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('instituicao_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('endereco_id')->unsigned();
            $table->enum('cargo', ['ATENDENTE','EQUIPE APOIO','COZINHEIRO','ASG','SEGURANÇA','ENFERMEIRO','SECRETARIA','ADMINISTRADOR','TI'])->default('ATENDENTE');
            $table->string('numero_endereco', 10)->nullable();
            $table->date('data_nascimento');
            $table->boolean('ativo')->default(1);
            $table->timestamps();
            $table->foreign('instituicao_id')->references('id')->on('instituicoes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colaboradores');
    }
};
