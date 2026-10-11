<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake()->unique()->numberBetween(100, 999),
            'type' => fake()->randomElement(['single', 'double', 'suite']),
            'price_per_night' => fake()->randomFloat(2, 50, 400),
        ];
    }
}
