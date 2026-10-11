<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkIn = fake()->dateTimeBetween('-1 month', '+1 month')->setTime(0, 0);
        $checkOut = (clone $checkIn)->modify('+' . fake()->numberBetween(1, 7) . ' days');

        return [
            'user_id' => fake()->numberBetween(1, 6),
            'room_id' => fake()->numberBetween(1, 10),
            'guest_id' => fake()->numberBetween(1, 10),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'total_price' => fake()->randomFloat(2, 50, 2000),
            'status' => 'booked',
        ];
    }
}
