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
        Schema::create('desabrigados', function (Blueprint $table) {
            $table->id();
            $table->char('certidao_nascimento', 40)->nullable();
            $table->char('cartao_sus', 15)->nullable();
            $table->string('nome');
            $table->string('sobrenome');
            $table->string('rg', 15)->nullable();
            $table->string('cpf', 14)->nullable();
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
        Schema::dropIfExists('desabrigados');
    }
};
