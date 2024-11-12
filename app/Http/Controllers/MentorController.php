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

       // Fetch mentees who are not yet clients of this mentor
       $availableMentees = User::where('role', 'mentee')
           ->whereDoesntHave('mentor', function ($query) use ($mentor) {
               $query->where('mentor_id', $mentor->id);
           })
           ->get();

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
       ]);

       $mentor = Auth::user();

       // Create the new session (appointment)
       Appt::create([
           'mentor_id' => $mentor->id,
           'mentee_id' => $request->mentee_id,
           'start_time' => Carbon::parse($request->start_time),
           'end_time' => Carbon::parse($request->end_time),
           'status' => 'confirmed',
       ]);

       return redirect()->route('mentor.dashboard')
           ->with('status', 'Session successfully created.');
   }
}