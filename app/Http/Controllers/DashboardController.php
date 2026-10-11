<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $arrivals = Booking::with(['room', 'guest'])
            ->whereDate('check_in', today())
            ->where('status', '!=', 'cancelled')
            ->get();

        $departures = Booking::with(['room', 'guest'])
            ->whereDate('check_out', today())
            ->where('status', '!=', 'cancelled')
            ->get();

        return view('dashboard', compact('arrivals', 'departures'));
    }
}
