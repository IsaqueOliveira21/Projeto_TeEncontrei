<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endereco>
 */
class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $tipos = ['Rua','Avenida','Travessa','Praça'];
        return [
           'cep'=>substr($this->faker->postcode(),0,9),
           'tipo_logradouro' => $tipos[rand(0,3)],
           'logradouro' => $this->faker->address(),
           'bairro' => $this->faker->city(),
           'cidade' => $this->faker->city(),
           'uf' => Str::random(2)
        ];
    }
}
