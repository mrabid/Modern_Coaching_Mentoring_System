<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center py-4 px-6 rounded-lg">
            <h2 class="font-semibold text-3xl dark:text-white text-black leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Message Section -->
            <div id="welcome-message" class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl p-6">
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-600 rounded-full h-14 w-14 flex items-center justify-center text-white shadow-lg">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 id="dynamic-greeting" class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            Welcome back, {{ Auth::user()->name }}!
                        </h3>
                        <div class="flex items-center gap-2 mt-1">
                            <span id="current-time" class="text-sm font-medium text-blue-600 dark:text-blue-400"></span>
                            <span class="text-gray-400 dark:text-gray-500">•</span>
                            <span id="current-date" class="text-sm text-gray-600 dark:text-gray-400"></span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">
                            Manage your platform, monitor activities, and ensure smooth operation of the mentorship program.
                        </p>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const greetingElement = document.getElementById("dynamic-greeting");
                    const timeElement = document.getElementById("current-time");
                    const dateElement = document.getElementById("current-date");
                    
                    function updateGreeting() {
                        const currentHour = new Date().getHours();
                        const userName = "{{ Auth::user()->name }}";
                        let greeting;
                        
                        if (currentHour >= 5 && currentHour < 12) {
                            greeting = "Good Morning";
                        } else if (currentHour >= 12 && currentHour < 17) {
                            greeting = "Good Afternoon";
                        } else if (currentHour >= 17 && currentHour < 22) {
                            greeting = "Good Evening";
                        } else {
                            greeting = "Good Night";
                        }
                        
                        greetingElement.textContent = `${greeting}, ${userName}!`;
                    }
                    
                    function updateDateTime() {
                        const now = new Date();
                        
                        // Update time
                        timeElement.textContent = now.toLocaleTimeString('en-US', {
                            hour: 'numeric',
                            minute: '2-digit',
                            hour12: true
                        });
                        
                        // Update date
                        dateElement.textContent = now.toLocaleDateString('en-US', {
                            weekday: 'long',
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric'
                        });
                    }
                    
                    // Initial updates
                    updateGreeting();
                    updateDateTime();
                    
                    // Update time every second
                    setInterval(updateDateTime, 1000);
                    
                    // Update greeting every minute
                    setInterval(updateGreeting, 60000);
                });
            </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Main Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            
                <!-- Mentors Overview -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl border border-blue-100 dark:border-blue-900">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Mentor Overview</h3>
                            <div class="bg-blue-100 rounded-full p-3 dark:bg-blue-900">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-6">
                            <p class="text-4xl font-bold text-gray-900 dark:text-gray-100">{{ $mentorCount }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Total Active Mentors</p>
                            <div class="mt-4 flex items-center justify-between">
                                <div>
                                    
                                </div>
                                <button class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-sm hover:bg-blue-100 dark:bg-blue-900 dark:text-blue-400 dark:hover:bg-blue-800">
                                    View All →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mentees Overview -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl border border-green-100 dark:border-green-900">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Mentee Overview</h3>
                            <div class="bg-green-100 rounded-full p-3 dark:bg-green-900">
                                <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-6">
                            <p class="text-4xl font-bold text-gray-900 dark:text-gray-100">{{ $menteeCount }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Active Mentees</p>
                            <div class="mt-4 flex items-center justify-between">
                                <div>
                                   
                                </div>
                                <button class="bg-green-50 text-green-600 px-3 py-1 rounded-lg text-sm hover:bg-green-100 dark:bg-green-900 dark:text-green-400 dark:hover:bg-green-800">
                                    View All →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sessions Overview -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl border border-purple-100 dark:border-purple-900">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Sessions Overview</h3>
                            <div class="bg-purple-100 rounded-full p-3 dark:bg-purple-900">
                                <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-6">
                            <p class="text-4xl font-bold text-gray-900 dark:text-gray-100">{{ $sessionCount }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Total Sessions</p>
                            <div class="mt-4 flex items-center justify-between">
                                <div>
                                    
                                </div>
                                <button class="bg-purple-50 text-purple-600 px-3 py-1 rounded-lg text-sm hover:bg-purple-100 dark:bg-purple-900 dark:text-purple-400 dark:hover:bg-purple-800">
                                    View All →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Administrative Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Management Tools -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Management Tools</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Mentor Management -->
                            <button class="relative group">
                                <div class="absolute inset-0 bg-blue-200 rounded-lg blur opacity-75 group-hover:opacity-100 transition duration-200"></div>
                                <div class="relative p-4 bg-white dark:bg-gray-800 border border-blue-100 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-gray-900 dark:text-gray-100 font-medium">Mentor Management</span>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        Verify and manage mentor profiles
                                    </p>
                                </div>
                            </button>

                            <!-- Session Monitoring -->
                            <button class="relative group">
                                <div class="absolute inset-0 bg-green-200 rounded-lg blur opacity-75 group-hover:opacity-100 transition duration-200"></div>
                                <div class="relative p-4 bg-white dark:bg-gray-800 border border-green-100 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span class="text-gray-900 dark:text-gray-100 font-medium">Session Monitor</span>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        Track ongoing sessions
                                    </p>
                                </div>
                            </button>

                            <!-- Reports Generation -->
                            <button class="relative group">
                                <div class="absolute inset-0 bg-purple-200 rounded-lg blur opacity-75 group-hover:opacity-100 transition duration-200"></div>
                                <div class="relative p-4 bg-white dark:bg-gray-800 border border-purple-100 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <span class="text-gray-900 dark:text-gray-100 font-medium">Reports</span>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        Generate performance reports
                                    </p>
                                </div>
                            </button>

                            <!-- Support System -->
                            <button class="relative group">
                                <div class="absolute inset-0 bg-red-200 rounded-lg blur opacity-75 group-hover:opacity-100 transition duration-200"></div>
                                <div class="relative p-4 bg-white dark:bg-gray-800 border border-red-100 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                        </svg>
                                        <span class="text-gray-900 dark:text-gray-100 font-medium">Support</span>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        Handle user support tickets
                                    </p>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

                

            

            <!-- Activity Feed -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Recent Activity</h3>
                        <button class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                            View All →
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900 rounded-full p-2">
                                <svg class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800 dark:text-gray-200">New mentor registration: <span class="font-medium">John Doe</span></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">2 minutes ago</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 bg-green-100 dark:bg-green-900 rounded-full p-2">
                                <svg class="h-4 w-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800 dark:text-gray-200">Session completed: <span class="font-medium">Web Development Basics</span></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">15 minutes ago</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 bg-purple-100 dark:bg-purple-900 rounded-full p-2">
                                <svg class="h-4 w-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800 dark:text-gray-200">Monthly report generated: <span class="font-medium">November 2023</span></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">1 hour ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>