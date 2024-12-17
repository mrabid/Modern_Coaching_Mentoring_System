<?php

namespace App\Http\Controllers;

use App\Models\Appt;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SessionController extends Controller
{
    public function adminIndex(Request $request): View
    {
        // Query sessions
        $query = Appt::with(['mentor', 'mentee']);

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->whereHas('mentor', function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%");
            })->orWhereHas('mentee', function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%");
            });
        }

        // Sorting
        $sort = $request->sort ?? 'start_time';
        $direction = $request->direction ?? 'desc';
        $query->orderBy($sort, $direction);

        // Get sessions with pagination
        $sessions = $query->paginate(10);

        // Get stats
        $totalSessions = Appt::count();
        $upcomingSessions = Appt::where('start_time', '>', now())->count();
        $completedSessions = Appt::where('start_time', '<', now())->count();

        return view('dashboard.admin.sessions.index', compact('sessions', 'totalSessions', 'upcomingSessions', 'completedSessions'));
    }

    public function show(Appt $session): View
    {
        return view('dashboard.admin.sessions.show', compact('session'));
    }
}