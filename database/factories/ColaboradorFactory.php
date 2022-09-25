<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Colaborador>
 */
class ColaboradorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $cargos = ['ATENDENTE','EQUIPE APOIO','COZINHEIRO','ASG','SEGURANÇA','ENFERMEIRO','SECRETARIA','ADMINISTRADOR','TI'];
        return [
            'instituicao_id' => rand(1,15),
            'user_id' => rand(1,20),
            'endereco_id' => rand(1,500),
            'cargo' => $cargos[rand(0, count($cargos) - 1)],
            'numero_endereco' => Str::random(10),
            'data_nascimento' => $this->faker->date,
            'ativo' => 1
        ];
    }
}
