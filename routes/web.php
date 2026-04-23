<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {

    // ─── Dashboard ───────────────────────────────────────────────
    Route::get('/dashboard', function () {
        $user = auth()->user();

        $recent_gifts = $user->gifts()->with('guest')->latest()->take(20)->get();

        $stats = [
            'total_cash' => $user->gifts()->where('type', 'cash')->sum('amount'),
            'total_items' => $user->gifts()->where('type', 'item')->count(),
            'total_guests' => $user->guests()->count(),
            'cash_contributors_count' => $user->gifts()->where('type', 'cash')->count(),
        ];

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'recent_gifts' => $recent_gifts,
        ]);
    })->name('dashboard');

    // ─── Guests ──────────────────────────────────────────────────
    Route::get('/guests', function () {
        return Inertia::render('GuestList', [
            'guests' => auth()->user()->guests()->with('gifts')->get(),
        ]);
    })->name('guests.index');

    // ─── Add Entry ───────────────────────────────────────────────
    Route::get('/add-entry', function () {
        return Inertia::render('AddEntry', [
            'recent_gifts' => auth()->user()->gifts()->with('guest')->latest()->take(20)->get(),
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

    // ─── Event Mode (legacy) ─────────────────────────────────────
    Route::get('/event-mode', function () {
        return Inertia::render('EventMode', [
            'recent_gifts' => auth()->user()->gifts()->with('guest')->latest()->take(5)->get(),
        ]);
    })->name('event-mode');

    // ─── Profile ─────────────────────────────────────────────────
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
