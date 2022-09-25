<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VisitaDetalhe>
 */
class VisitaDetalheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $tipos = ['CHECK-IN', 'CHECK-OUT'];
        return [
            'visita_cabecalho_id' => rand(1,500),
            'colaborador_id' => rand(1,100),
            'tipo' => $tipos[rand(0,1)]
        ];
    }
}
