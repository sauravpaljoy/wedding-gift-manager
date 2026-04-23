<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Gift;
use App\Models\Guest;

class ReportController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalCash = $user->gifts()->where('type', 'cash')->sum('amount');
        $totalItems = $user->gifts()->where('type', 'item')->count();
        $totalGuests = $user->guests()->count();

        // Cash by relation
        $byRelation = [];
        $relations = ['Family', 'Relative', 'Friend', 'Colleague'];
        foreach ($relations as $rel) {
            $byRelation[$rel] = $user->gifts()
                ->whereHas('guest', fn($q) => $q->where('relation', $rel))
                ->where('type', 'cash')
                ->sum('amount');
        }

        $cashContributors = $user->gifts()->where('type', 'cash')->count();

        return Inertia::render('Reports', [
            'stats' => [
                'total_cash' => $totalCash,
                'total_items' => $totalItems,
                'total_guests' => $totalGuests,
                'cash_contributors_count' => $cashContributors,
            ],
            'by_relation' => $byRelation,
        ]);
    }
}
