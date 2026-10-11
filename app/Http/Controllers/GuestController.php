<?php

namespace App\Http\Controllers;

use App\Models\Guest;
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

        return view('guests.show', compact('guest'));
    }
}
