<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'category_id' => rand(1,5),
            //'name' =>fake()->sentence(3),
            //'price' => rand(50000, 10000000),
            //'description' =>fake()->paragraph(5),

            'category_id' => rand(1,5),
            'name' => [
                'uz' => fake()->sentence(3),
                'ru' => 'Матрасы. Беспружинные матрасы',
            ],
            'price' => rand(50000, 10000000),
            'description' => [
                'uz' => fake()->paragraph(5),
                'ru' =>'Я тебя вижу во сне, утром ты уходишь от меня, и я не могу тебя остановить.',
             ],
        ];
    }
}
