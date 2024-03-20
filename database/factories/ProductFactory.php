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
//            'code' => $this->faker->unique()->regexify('/[A-Z]{3}[0-9]{3}/'),
            'code' => 'SR1',
//            'code' => $this->randomCode(),
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }

    private function randomCode(): string
    {
        return strtoupper($this->faker->randomLetter())
            . strtoupper($this->faker->randomLetter())
            . strtoupper($this->faker->randomLetter())
            . $this->faker->randomNumber(5);

    }
}
