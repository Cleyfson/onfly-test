<?php

namespace Database\Factories;

use App\Models\Despesa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DespesaFactory extends Factory
{
    protected $model = Despesa::class;

    public function definition()
    {
        return [
            'descricao' => $this->faker->sentence,
            'data' => $this->faker->date,
            'user_id' => User::factory(),
            'valor' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
