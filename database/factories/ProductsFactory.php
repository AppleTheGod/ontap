<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(3),
            'price' => $this->faker->numberBetween(1000, 50000),
            'quantity' => $this->faker->numberBetween(0, 500),
            'description' => $this->faker->paragraph(5),
            'category_id' => $this->faker->numberBetween(1, 30),
            'img' => $this->faker->imageUrl(),
        ];
    }
}
