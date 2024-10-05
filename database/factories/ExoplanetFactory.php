<?php

namespace Database\Factories;

use App\Models\Enums\ExoplanetType;
use App\Models\Star;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Planet>
 */
class ExoplanetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(ExoplanetType::values()),
            'description' => $this->faker->text,
            'mass' => $this->faker->randomFloat(2, 0, 100),
            'radius' => $this->faker->randomFloat(2, 0, 100),
            'orbital_period' => $this->faker->randomFloat(2, 0, 100),
            'semi_major_axis' => $this->faker->randomFloat(2, 0, 100),
            'eccentricity' => $this->faker->randomFloat(2, 0, 100),
            'temperature' => $this->faker->randomFloat(2, 0, 100),
            'gravity' => $this->faker->randomFloat(2, 0, 100),
            'density' => $this->faker->randomFloat(2, 0, 100),
            'habitability' => $this->faker->boolean,
            'surface_conditions' => $this->faker->text,
            'age' => $this->faker->randomFloat(2, 0, 100),
            'distance_from_earth' => $this->faker->randomFloat(2, 0, 100),
            'travel_time' => $this->faker->randomFloat(2, 0, 100),
            'discovered_method' => $this->faker->text,
            'exoplanet_type' => $this->faker->text,
            'planet_texture' => $this->faker->text,
            'surface_photos' => $this->faker->text,
            'locals_portrait' => $this->faker->text,
            'flora_photos' => $this->faker->text,
            'camp_photo' => $this->faker->text,
            'background' => $this->faker->text,
        ];
    }

    public function withStar(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'star_id' => Star::factory()->create()->id,
            ];
        });
    }
}
