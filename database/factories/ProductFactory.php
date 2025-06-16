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
        'name' => $this->faker->word(),
        'type' => $this->faker->randomElement(['equipment', 'raw_material']),
        'quantity' => $this->faker->numberBetween(5, 100),
        'unit' => 'pcs',
    ];
}

}
