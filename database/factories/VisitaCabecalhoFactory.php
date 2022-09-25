<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VisitaCabecalho>
 */
class VisitaCabecalhoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'instituicao_id' => rand(1,15),
            'desabrigado_id' => rand(1,100),
        ];
    }
}
