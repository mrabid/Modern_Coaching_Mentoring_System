<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MentorController;
use Illuminate\Support\Facades\Auth;  // Added Auth facade

Route::get('/', function () {
   return view('welcome');
});

/**
* Key Change #1: Updated the dashboard route to include role-based redirection
* This ensures users are automatically directed to their appropriate dashboard on login
*/
Route::get('/dashboard', function () {
   $user = Auth::user();   // Changed to use Auth facade
   
   if ($user->role === 'mentor') {
       return redirect()->route('mentor.dashboard');
   }
   
   if ($user->role === 'mentee') {
       return redirect()->route('mentee.dashboard');
   }
   
   if ($user->role === 'admin') {
       return redirect()->route('admin.dashboard');
   }
   
   return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
* Key Change #2: Removed duplicate mentor dashboard route that used DashboardController
* Only keeping routes for mentee and admin dashboards here
*/
Route::middleware(['auth', 'mentee'])->get('/mentee/dashboard', [DashboardController::class, 'mentee'])->name('mentee.dashboard');
Route::middleware(['auth', 'admin'])->get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

/**
* Key Change #3: Kept the mentor routes group that uses MentorController 
* This group contains all the necessary mentor functionality:
* - Dashboard with available mentees and sessions
* - Ability to coach mentees
* - Session creation and management
*/
Route::middleware(['auth', 'mentor'])->group(function () {
   Route::get('/mentor/dashboard', [MentorController::class, 'index'])->name('mentor.dashboard');
   Route::post('/mentor/coach/{mentee}', [MentorController::class, 'coach'])->name('mentor.coach');
   Route::get('/mentor/session/create', [MentorController::class, 'createSession'])->name('mentor.session.create');
   Route::post('/mentor/session/store', [MentorController::class, 'storeSession'])->name('mentor.session.store');
});

/**
* After these changes:
* - Mentors will go to their dashboard with all features (available mentees, sessions, etc.)
* - Mentees will go to their dashboard
* - Admins will go to their dashboard
* 
* To test: Log in with a mentor account - it should take you directly to the mentor dashboard
*/

require __DIR__.'/auth.php';