<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function index(): View
    {
        $rooms = Room::all();

        return view('rooms.index', compact('rooms'));
    }

    public function show($id): View
    {
        $room = Room::find($id);

        return view('rooms.show', compact('room'));
    }
}
