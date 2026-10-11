<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'is_staff' => true,
            'is_manager' => true,
        ]);

        User::factory(5)->create();
        Room::factory(10)->create();
        Guest::factory(10)->create();

        $this->seedBookings();
    }

    // Each room gets its stays one after another, so no two bookings of the same
    // room can overlap and contradict the double-booking rule.
    private function seedBookings(): void
    {
        $userIds = User::pluck('id');
        $guestIds = Guest::pluck('id');
        $rooms = Room::all();

        // Two rooms are set aside for stays that touch today, so the dashboard
        // always has an arrival to check in and a departure to check out.
        $arrivalRoom = $rooms->shift();
        $departureRoom = $rooms->shift();

        Booking::factory()->create([
            'user_id' => $userIds->random(),
            'room_id' => $arrivalRoom->id,
            'guest_id' => $guestIds->random(),
            'check_in' => now()->startOfDay(),
            'check_out' => now()->startOfDay()->addDays(3),
            'status' => 'booked',
        ]);

        Booking::factory()->create([
            'user_id' => $userIds->random(),
            'room_id' => $departureRoom->id,
            'guest_id' => $guestIds->random(),
            'check_in' => now()->startOfDay()->subDays(2),
            'check_out' => now()->startOfDay(),
            'status' => 'checked_in',
        ]);

        foreach ($rooms as $room) {
            $nextFreeDay = now()->startOfDay()->subDays(rand(5, 25));

            foreach (range(1, rand(1, 2)) as $ignored) {
                $checkIn = $nextFreeDay->copy();
                $checkOut = $checkIn->copy()->addDays(rand(1, 6));

                Booking::factory()->create([
                    'user_id' => $userIds->random(),
                    'room_id' => $room->id,
                    'guest_id' => $guestIds->random(),
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                ]);

                $nextFreeDay = $checkOut->copy()->addDays(rand(1, 6));
            }
        }
    }
}
