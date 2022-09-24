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
        Schema::create('visitas_cabecalhos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('instituicao_id')->unsigned();
            $table->bigInteger('desabrigado_id')->unsigned();
            $table->timestamps();
            $table->foreign('instituicao_id')->references('id')->on('instituicoes')->onDelete('cascade');
            $table->foreign('desabrigado_id')->references('id')->on('desabrigados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas_cabecalhos');
    }
};
