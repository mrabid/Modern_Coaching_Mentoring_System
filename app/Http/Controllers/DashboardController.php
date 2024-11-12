<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Redirect to appropriate dashboard based on user role.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'mentor') {
            return redirect()->route('mentor.dashboard');
        }
        
        if ($user->role === 'mentee') {
            return redirect()->route('mentee.dashboard');
        }
        
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        return view('dashboard');
    }

    /**
     * Display the Mentor Dashboard.
     */
    public function mentor()
    {
        return view('dashboard.mentor');
    }

    /**
     * Display the Mentee Dashboard.
     */
    public function mentee()
    {
        return view('dashboard.mentee');
    }

    /**
     * Display the Admin Dashboard.
     */
    public function admin()
    {
        // Get counts for admin dashboard
        $mentorCount = User::where('role', 'mentor')->count();
        $menteeCount = User::where('role', 'mentee')->count();
        $sessionCount = Appt::count();

        // For recent activities, we'll add this later
        $recentActivities = [];

        return view('dashboard.admin', compact(
            'mentorCount',
            'menteeCount',
            'sessionCount',
            'recentActivities'
        ));
    }
}