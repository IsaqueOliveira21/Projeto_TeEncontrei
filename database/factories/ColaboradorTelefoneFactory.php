<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ColaboradorTelefone>
 */
class ColaboradorTelefoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'colaborador_id' => rand(1,100),
            'numero_telefone' => substr($this->faker->phoneNumber(), 0, 15)
        ];
    }
}
