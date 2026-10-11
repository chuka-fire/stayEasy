<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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

        return view('bookings.show', compact('booking'));
    }
}
