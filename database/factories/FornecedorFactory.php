<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornecedor>
 */
class FornecedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Construir um CNPJ de 14 dígitos usando randomDigit
        $cnpj = '';
        for ($i = 0; $i < 14; $i++) {
            $cnpj .= $this->faker->randomDigit;
        }
        return [
            'nome' => $this->faker->company(),
            'cnpj' => $cnpj,
            'email' => $this->faker->unique()->companyEmail(),
            'criado_em' => Carbon::now()
        ];
    }
}
