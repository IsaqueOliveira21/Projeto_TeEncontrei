<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Desabrigado>
 */
class DesabrigadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'certidao_nascimento' => Str::random(40),
            'cartao_sus' => Str::random(15),
            'nome' => $this->faker->name(),
            'sobrenome' => $this->faker->lastName(),
            'rg' => Str::random(15),
            'cpf' => Str::random(14)
        ];
    }
}
