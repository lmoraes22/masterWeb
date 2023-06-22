<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{

    protected $model = Produto::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'descricao' => $this->faker->paragraph(2),
            'preco' => $this->faker->randomDigit(),
            'estoque' => $this->faker->randomDigit(),
            'imagem' => $this->faker->sentence(5),
        ];
    }
}
