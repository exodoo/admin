<?php

namespace Database\Factories;

use App\Models\Enums\StarType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Star>
 */
class StarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(StarType::values()),
            'image' => $this->faker->imageUrl(),
            'mass' => $this->faker->randomFloat(2, 0, 100),
            'radius' => $this->faker->randomFloat(2, 0, 100),
            'temperature' => $this->faker->randomFloat(2, 0, 100),
            'age' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
