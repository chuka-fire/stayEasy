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

        abort_unless($room, 404);

        return view('rooms.show', compact('room'));
    }

    public function create(): View
    {
        abort_unless(auth()->user()->isManager(), 403);

        return view('rooms.create');
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()->isManager(), 403);

        $validated = $request->validate([
            'number' => 'required|unique:rooms,number',
            'type' => 'required|in:single,double,suite',
            'price_per_night' => 'required|numeric|gt:0',
        ]);

        $room = Room::create($validated);

        return redirect()->route('rooms.show', $room->id)
            ->with('message', 'Room saved.');
    }

    public function edit($id): View
    {
        abort_unless(auth()->user()->isManager(), 403);

        $room = Room::find($id);

        abort_unless($room, 404);

        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        abort_unless(auth()->user()->isManager(), 403);

        $room = Room::find($id);

        abort_unless($room, 404);

        $validated = $request->validate([
            'number' => 'required|unique:rooms,number,'.$id,
            'type' => 'required|in:single,double,suite',
            'price_per_night' => 'required|numeric|gt:0',
        ]);

        $room->update($validated);

        return redirect()->route('rooms.show', $room->id)
            ->with('message', 'Room updated.');
    }

    public function destroy($id): RedirectResponse
    {
        abort_unless(auth()->user()->isManager(), 403);

        $room = Room::find($id);

        abort_unless($room, 404);

        $room->delete();

        return redirect()->route('rooms.index')
            ->with('message', 'Room deleted.');
    }
}
