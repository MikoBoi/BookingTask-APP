<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return redirect('/events');
});

Route::get('/events', [EventController::class, 'showEvents'])->middleware(['auth', 'verified'])->name('events');

Route::get('/events/{id}', [EventController::class, 'showEvent']);

Route::get('/events/{id}/purchase', [EventController::class, 'toPurchase']);

Route::post('/order', [OrderController::class, 'store'])->name('form.submit');

Route::get('/tickets', [TicketController::class, 'showTickets']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
