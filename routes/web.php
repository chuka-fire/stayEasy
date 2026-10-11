<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])->middleware('manager')->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->middleware('manager')->name('rooms.store');
    Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
    Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->middleware('manager')->name('rooms.edit');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->middleware('manager')->name('rooms.update');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->middleware('manager')->name('rooms.destroy');

    Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
    Route::get('/guests/create', [GuestController::class, 'create'])->name('guests.create');
    Route::post('/guests', [GuestController::class, 'store'])->name('guests.store');
    Route::get('/guests/{id}', [GuestController::class, 'show'])->name('guests.show');

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{id}/status', [BookingController::class, 'updateStatus'])->name('bookings.status');

    Route::get('/users', [UserController::class, 'index'])->middleware('manager')->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->middleware('manager')->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->middleware('manager')->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware('manager')->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->middleware('manager')->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('manager')->name('users.destroy');
});

require __DIR__.'/auth.php';
