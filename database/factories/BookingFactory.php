<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
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
        $checkOut = (clone $checkIn)->modify('+'.fake()->numberBetween(1, 7).' days');

        return [
            'user_id' => fake()->numberBetween(1, 6),
            'room_id' => fake()->numberBetween(1, 10),
            'guest_id' => fake()->numberBetween(1, 10),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'total_price' => 0,
            'status' => 'booked',
        ];
    }

    // Runs after any overrides are merged, so the price matches the room and dates
    // that are actually saved rather than the factory's own defaults.
    public function configure(): static
    {
        return $this->afterMaking(function (Booking $booking) {
            $room = Room::find($booking->room_id);
            $nights = Carbon::parse($booking->check_in)->diffInDays($booking->check_out);

            $booking->total_price = $nights * $room->price_per_night;
        });
    }
}
