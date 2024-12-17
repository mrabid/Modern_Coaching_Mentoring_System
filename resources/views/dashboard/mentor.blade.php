<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center py-4 px-6  rounded-lg">
            <h2 class="font-semibold text-3xl dark:text-white text-black leading-tight">
                {{ __('Mentor Dashboard') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <!-- Welcome Message Section -->
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
                            Here you can view your upcoming sessions, monitor mentee progress, and manage your mentoring tasks.
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


           <!-- Invite Mentees Section -->
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl p-6 ">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">Available Mentees</h3>
    <p class="text-gray-600 dark:text-gray-400 mb-6">
        Here is a list of mentees you can invite to be your clients. Click "Coach" to add them to your mentees.
    </p>

    <div class="space-y-4">
        @forelse($availableMentees as $mentee)
        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition">
            <div>
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $mentee->name }}</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $mentee->email }}</p>
            </div>
            <form method="POST" action="{{ route('mentor.coach', $mentee->id) }}">
                @csrf
                <x-primary-button>
                    {{ __('Start Mentoring') }}
                </x-primary-button>
            </form>
        </div>
        @empty
        <p class="text-gray-600 dark:text-gray-400">No available mentees to coach at this time.</p>
        @endforelse
    </div>

    <!-- Pagination Navigation -->
    @if($availableMentees->hasPages())
        <div class="mt-6 flex justify-between items-center border-t border-gray-200 dark:border-gray-600 pt-4">
            <div class="flex justify-start">
                @if($availableMentees->onFirstPage())
                    <span class="px-4 py-2 text-sm bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 rounded-md cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $availableMentees->previousPageUrl() }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg font-semibold transition">Previous</a>
                @endif

                @if($availableMentees->hasMorePages())
                    <a href="{{ $availableMentees->nextPageUrl() }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg font-semibold transition ml-3">Next</a>
                @endif
            </div>
            
            <div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Showing {{ $availableMentees->firstItem() }} to {{ $availableMentees->lastItem() }}
                    of {{ $availableMentees->total() }} mentees
                </p>
            </div>
        </div>
    @endif
</div>



          <!-- Upcoming Sessions Section -->
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl p-6">
    <div class="flex w-full justify-between mb-4">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">Upcoming Sessions</h3>
        <a href="{{ route('mentor.session.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg font-semibold transition mb-2">Add New Session</a>
    </div>

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg p-6 transition duration-300 hover:shadow-xl">
    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">📅 Upcoming Sessions</h3>

    @if($upcomingSessions->isEmpty())
        <p class="text-gray-600 dark:text-gray-400 mt-4">No upcoming sessions scheduled.</p>
    @else
        <ul class="mt-4 space-y-2 text-gray-600 dark:text-gray-400 list-disc list-inside">
            @foreach ($upcomingSessions as $session)
                <li>
                    Session with {{ $session->mentee->name }} 
                    on {{ \Carbon\Carbon::parse($session->start_time)->format('F jS, Y \a\t g:i A') }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
</div>


            <!-- JavaScript to Dynamically Load Sessions -->
            <script>
                // Sample data array for sessions
                const sessions = [{
                        name: 'Abid Doe',
                        date: 'Nov 8th at 10:00 AM',
                        color: 'bg-blue-500'
                    },
                    {
                        name: 'Jane Smith',
                        date: 'Nov 9th at 2:00 PM',
                        color: 'bg-green-500'
                    },
                    {
                        name: 'Emily Johnson',
                        date: 'Nov 10th at 4:00 PM',
                        color: 'bg-purple-500'
                    },
                ];

                // Function to load sessions dynamically
                function loadSessions() {
                    const container = document.getElementById('sessionsContainer');
                    container.innerHTML = '';

                    sessions.forEach(session => {
                        const sessionItem = document.createElement('div');
                        sessionItem.classList = 'flex items-start space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition';
                        sessionItem.innerHTML = `
                            <div class="${session.color} rounded-full h-10 w-10 flex items-center justify-center text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h.01M12 7h.01M16 7h.01M8 11h.01M12 11h.01M16 11h.01M9 16h6m-9 4h10a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Session with ${session.name}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">${session.date}</p>
                            </div>
                        `;
                        container.appendChild(sessionItem);
                    });
                }

                // Load sessions on page load
                document.addEventListener('DOMContentLoaded', loadSessions);
            </script>



            <!-- Mentee Progress -->
            <!-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg p-6 ">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Mentee Progress</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    View the progress of your mentees, track their goals, and provide feedback.
                </p>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-6">
                 
                    <div class="col-span-1 sm:col-span-1">
                        <canvas id="menteeProgressChart" class="w-full h-64"></canvas>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('menteeProgressChart').getContext('2d');
        var menteeProgressChart = new Chart(ctx, {
            type: 'bar', // Choose a chart type, e.g., 'bar', 'line', 'pie'
            data: {
                labels: ['John Doe', 'Jane Smith'],
                datasets: [{
                    label: 'Progress',
                    data: [75, 50], // Data for mentees' progress
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 159, 64, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 159, 64, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                },
                responsive: true,
                maintainAspectRatio: false // Ensures chart resizes based on its container
            }
        });
    </script>
</x-app-layout>