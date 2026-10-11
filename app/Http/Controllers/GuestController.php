<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function index(): View
    {
        $guests = Guest::all();

        return view('guests.index', compact('guests'));
    }

    public function show($id): View
    {
        $guest = Guest::find($id);

        abort_unless($guest, 404);

        return view('guests.show', compact('guest'));
    }

    public function create(): View
    {
        return view('guests.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $guest = Guest::create($validated);

        return redirect()->route('guests.show', $guest->id)
            ->with('message', 'Guest saved.');
    }
}
