<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instituicao>
 */
class InstituicaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'endereco_id' => rand(1,500),
            'nomeclatura' => $this->faker->company(),
            'capacidade' => rand(50,100),
            'numero_endereco' => Str::random(10),
        ];
    }
}
