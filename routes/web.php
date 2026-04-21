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
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;

Route::middleware(['auth', 'verified'])->group(function () {

    // ─── Dashboard ───────────────────────────────────────────────
    Route::get('/dashboard', function () {
        $userId = auth()->id();

        $recent_gifts = \App\Models\Gift::with('guest')
            ->whereHas('event', fn($q) => $q->where('user_id', $userId))
            ->latest()
            ->take(20)
            ->get();

        $stats = [
            'total_cash' => \App\Models\Gift::whereHas('event', fn($q) => $q->where('user_id', $userId))
                ->where('type', 'cash')->sum('amount'),
            'total_items' => \App\Models\Gift::whereHas('event', fn($q) => $q->where('user_id', $userId))
                ->where('type', 'item')->count(),
            'total_guests' => \App\Models\Guest::whereHas('event', fn($q) => $q->where('user_id', $userId))->count(),
        ];

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'recent_gifts' => $recent_gifts,
        ]);
    })->name('dashboard');

    // ─── Guests ──────────────────────────────────────────────────
    Route::get('/guests', function () {
        $userId = auth()->id();
        return Inertia::render('GuestList', [
            'guests' => \App\Models\Guest::with(['event', 'gifts'])
                ->whereHas('event', fn($q) => $q->where('user_id', $userId))
                ->get(),
        ]);
    })->name('guests.index');

    // ─── Add Entry ───────────────────────────────────────────────
    Route::get('/add-entry', function () {
        $userId = auth()->id();
        return Inertia::render('AddEntry', [
            'recent_gifts' => \App\Models\Gift::with('guest')
                ->whereHas('event', fn($q) => $q->where('user_id', $userId))
                ->latest()->take(20)->get(),
        ]);
    })->name('gifts.create');

    // ─── Reports ─────────────────────────────────────────────────
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/export/csv', [ExportController::class, 'csv'])->name('export.csv');

    // ─── Reminders ───────────────────────────────────────────────
    Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');
    Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');
    Route::delete('/reminders/{reminder}', [ReminderController::class, 'destroy'])->name('reminders.destroy');

    // ─── Settings ────────────────────────────────────────────────
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // ─── Gifts / Entry CRUD ──────────────────────────────────────
    Route::post('/gifts', [GiftController::class, 'store'])->name('gifts.store');
    Route::patch('/guests/{guest}', [GiftController::class, 'update'])->name('guests.update');
    Route::delete('/guests/{guest}', [GiftController::class, 'destroy'])->name('guests.destroy');

    // ─── Events ──────────────────────────────────────────────────
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');

    // ─── Event Mode (legacy) ─────────────────────────────────────
    Route::get('/event-mode', function () {
        $userId = auth()->id();
        return Inertia::render('EventMode', [
            'events' => \App\Models\Event::all(),
            'recent_gifts' => \App\Models\Gift::with('guest')
                ->whereHas('event', fn($q) => $q->where('user_id', $userId))
                ->latest()->take(5)->get(),
        ]);
    })->name('event-mode');

    // ─── Profile ─────────────────────────────────────────────────
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
