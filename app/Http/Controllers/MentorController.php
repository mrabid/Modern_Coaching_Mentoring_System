<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Collection;

class MentorController extends Controller
{
    /**
     * Display mentor dashboard with available mentees and upcoming sessions.
     */
    public function index(): View
    {
        $mentor = Auth::user();

        // Fetch mentees who are not yet clients of this mentor with pagination
        $availableMentees = User::where('role', 'mentee')
            ->whereDoesntHave('mentor', function ($query) use ($mentor) {
                $query->where('mentor_id', $mentor->id);
            })
            ->paginate(5);

        // Fetch upcoming sessions for this mentor
        $upcomingSessions = Appt::where('mentor_id', $mentor->id)
            ->where('start_time', '>', now())
            ->orderBy('start_time')
            ->get();

        return view('dashboard.mentor', compact('availableMentees', 'upcomingSessions'));
    }


    /**
     * Assign a mentee to the mentor as a client.
     */
    public function coach(User $mentee): RedirectResponse
    {
        $mentor = Auth::user();

        // Attach the mentee to the mentor as a client
        $mentor->clients()->attach($mentee->id);

        return redirect()->route('mentor.dashboard')
            ->with('status', 'You are now coaching this mentee.');
    }

    /**
     * Show the session creation form.
     */
    public function createSession(): View
    {
        // Get available mentees for the current mentor
        $mentor = Auth::user();
        $availableMentees = $mentor->clients;

        return view('mentor.create-session', compact('availableMentees'));
    }

    /**
     * Store a newly created session.
     */
    public function storeSession(Request $request): RedirectResponse
    {
        $request->validate([
            'mentee_id' => 'required|exists:users,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:15|max:120',
            'session_details' => 'required|string|max:255',

        ]);

        $mentor = Auth::user();

        // Create the new session (appointment)
        Appt::create([
            'mentor_id' => $mentor->id,
            'mentee_id' => $request->mentee_id,
            'start_time' => Carbon::parse($request->start_time),
            'end_time' => Carbon::parse($request->end_time),
            'status' => 'confirmed',
            'session_details' => $request->session_details,
            'duration' => $request->duration,
        ]);

        return redirect()->route('mentor.dashboard')
            ->with('status', 'Session successfully created.');
    }




    public function showMenteeSessions(User $mentee): View
    {
        $mentor = Auth::user();

        // Check if the mentee belongs to the mentor's clients
        if (!$mentor->clients()->where('id', $mentee->id)->exists()) {
            abort(403, 'Unauthorized action.');
        }

        // Fetch the sessions for the mentee
        $sessions = Appt::where('mentor_id', $mentor->id)
            ->where('mentee_id', $mentee->id)
            ->orderBy('start_time', 'asc')
            ->get();

        return view('mentor.mentee-sessions', compact('mentee', 'sessions'));
    }

    /**
     * Display a listing of all mentors for admin.
     */
    public function adminIndex(Request $request): View
    {
        // Query mentors (users with mentor role)
        $query = User::where('role', 'mentor')
            ->withCount('clients'); // Count mentees/clients for each mentor

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }

        // Sorting
        $sort = $request->sort ?? 'name';
        $direction = $request->direction ?? 'asc';
        $query->orderBy($sort, $direction);

        // Get mentors with pagination
        $mentors = $query->paginate(10);

        // Get some basic stats
        $totalMentors = User::where('role', 'mentor')->count();
        $totalActiveMentors = User::where('role', 'mentor')
            ->whereHas('clients')
            ->count();

        return view('dashboard.admin.mentors.index', compact('mentors', 'totalMentors', 'totalActiveMentors'));
    }

    public function show(User $mentor): View
    {
        return view('dashboard.admin.mentors.show', compact('mentor'));
    }
}
