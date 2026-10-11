<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function create(): View
    {
        return view('rooms.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $room = Room::create([
            'number' => $request->number,
            'type' => $request->type,
            'price_per_night' => $request->price_per_night,
        ]);

        return redirect()->route('rooms.show', $room->id);
    }

    public function edit($id): View
    {
        $room = Room::find($id);

        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $room = Room::find($id);

        $room->update([
            'number' => $request->number,
            'type' => $request->type,
            'price_per_night' => $request->price_per_night,
        ]);

        return redirect()->route('rooms.show', $room->id);
    }

    public function destroy($id): RedirectResponse
    {
        Room::find($id)->delete();

        return redirect()->route('rooms.index');
    }
}
