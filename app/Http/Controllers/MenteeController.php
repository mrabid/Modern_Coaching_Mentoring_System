<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenteeController extends Controller
{
    /**
     * Display a listing of all mentees for admin.
     */
    public function adminIndex(Request $request): View
    {
        // Query mentees (users with mentee role)
        $query = User::where('role', 'mentee')
            ->withCount('mentor');

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }

        // Sorting
        $sort = $request->sort ?? 'name';
        $direction = $request->direction ?? 'asc';
        $query->orderBy($sort, $direction);

        // Get mentees with pagination
        $mentees = $query->paginate(10);

        // Get some basic stats
        $totalMentees = User::where('role', 'mentee')->count();
        $totalActiveMentees = User::where('role', 'mentee')
            ->whereHas('mentor')
            ->count();

        return view('dashboard.admin.mentees.index', compact('mentees', 'totalMentees', 'totalActiveMentees'));
    }

    /**
     * Display the specified mentee.
     */
    public function show(User $mentee): View
    {
        return view('dashboard.admin.mentees.show', compact('mentee'));
    }
}