<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        $bookings = Booking::with(['room', 'guest'])->get();

        return view('bookings.index', compact('bookings'));
    }

    public function show($id): View
    {
        $booking = Booking::find($id);

        abort_unless($booking, 404);

        return view('bookings.show', compact('booking'));
    }

    public function create(): View
    {
        $rooms = Room::all();
        $guests = Guest::all();

        return view('bookings.create', compact('rooms', 'guests'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'guest_id' => 'required|exists:guests,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $isTaken = Booking::where('room_id', $validated['room_id'])
            ->where('status', '!=', 'cancelled')
            ->whereDate('check_in', '<', $validated['check_out'])
            ->whereDate('check_out', '>', $validated['check_in'])
            ->exists();

        if ($isTaken) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['room_id' => 'This room is already booked for those dates.']);
        }

        $room = Room::find($validated['room_id']);
        $nights = Carbon::parse($validated['check_in'])->diffInDays($validated['check_out']);

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $validated['room_id'],
            'guest_id' => $validated['guest_id'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'total_price' => $nights * $room->price_per_night,
            'status' => 'booked',
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('message', 'Booking saved.');
    }

    public function updateStatus(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:booked,checked_in,checked_out,cancelled',
        ]);

        if ($validated['status'] === 'cancelled' && ! auth()->user()->isManager()) {
            abort(403);
        }

        $booking = Booking::find($id);

        abort_unless($booking, 404);

        $nextStatuses = [
            'booked' => ['checked_in', 'cancelled'],
            'checked_in' => ['checked_out', 'cancelled'],
            'checked_out' => [],
            'cancelled' => [],
        ];

        if (! in_array($validated['status'], $nextStatuses[$booking->status])) {
            return redirect()->route('bookings.show', $booking->id)
                ->with('warning', 'That status change is not allowed.');
        }

        $booking->update(['status' => $validated['status']]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('message', 'Booking updated.');
    }
}
