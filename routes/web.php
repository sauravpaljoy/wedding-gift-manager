<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

use App\Http\Controllers\GiftController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\EventController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/export/csv', [ExportController::class, 'csv'])->name('export.csv');
    Route::get('/dashboard', function () {
        $userId = auth()->id();
        
        $stats = [
            'total_cash' => \App\Models\Gift::whereHas('event', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })->where('type', 'cash')->sum('amount'),
            
            'total_items' => \App\Models\Gift::whereHas('event', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })->where('type', 'item')->count(),
            
            'total_guests' => \App\Models\Guest::whereHas('event', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })->count(),
        ];
        
        return Inertia::render('Dashboard', [
            'stats' => $stats
        ]);
    })->name('dashboard');

    Route::get('/event-mode', function () {
        return Inertia::render('EventMode', [
            'events' => \App\Models\Event::all(),
            'recent_gifts' => \App\Models\Gift::with('guest')->latest()->take(5)->get()
        ]);
    })->name('event-mode');

    Route::post('/gifts', [GiftController::class, 'store'])->name('gifts.store');
    Route::patch('/guests/{guest}', [GiftController::class, 'update'])->name('guests.update');
    Route::delete('/guests/{guest}', [GiftController::class, 'destroy'])->name('guests.destroy');

    Route::get('/guests', function () {
        return Inertia::render('GuestList', [
            'guests' => \App\Models\Guest::with(['event', 'gifts'])->get(),
            'events' => \App\Models\Event::all()
        ]);
    })->name('guests.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
