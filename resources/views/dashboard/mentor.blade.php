<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center py-4 px-6  rounded-lg">
            <h2 class="font-semibold text-3xl text-white leading-tight">
                {{ __('Mentor Dashboard') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Message Section -->
            <div id="welcome-message" class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl p-6 ">
                <div class="flex items-center space-x-4">
                    <div class="bg-indigo-500 rounded-full h-12 w-12 flex items-center justify-center text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A5.5 5.5 0 0010 22h4a5.5 5.5 0 004.879-4.196M9.5 15a5.5 5.5 0 01-5.45-6.832 3.5 3.5 0 015.13-.5 3.5 3.5 0 015.64 1.332M9 12h.01M15 12h.01M12 12h.01M9 15h6"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 id="dynamic-greeting" class="text-2xl font-bold text-gray-900 dark:text-gray-100">Welcome, Mentor!</h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">
                            Here you can view your upcoming sessions, monitor mentee progress, and manage your mentoring tasks.
                        </p>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const greetingElement = document.getElementById("dynamic-greeting");
                    const currentHour = new Date().getHours();

                    let greeting;
                    if (currentHour < 12) {
                        greeting = "Good Morning, Mentor!";
                    } else if (currentHour < 18) {
                        greeting = "Good Afternoon, Mentor!";
                    } else {
                        greeting = "Good Evening, Mentor!";
                    }

                    greetingElement.textContent = greeting;
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
            </div>



          <!-- Upcoming Sessions Section -->
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl p-6">
    <div class="flex w-full justify-between mb-4">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">Upcoming Sessions</h3>
        <a href="{{ route('mentor.session.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg font-semibold transition mb-2">Add New Session</a>
    </div>

    <div class="space-y-4">
        @forelse($upcomingSessions as $session)
        <div class="flex items-start space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition">
            <div class="bg-indigo-500 rounded-full h-10 w-10 flex items-center justify-center text-white">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h.01M12 7h.01M16 7h.01M8 11h.01M12 11h.01M16 11h.01M9 16h6m-9 4h10a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Session with {{ $session->mentee->name }}</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $session->start_time->format('M jS, Y - g:i A') }} to {{ $session->end_time->format('g:i A') }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Status: {{ ucfirst($session->status) }}</p>
            </div>
        </div>
        @empty
        <p class="text-gray-600 dark:text-gray-400">No upcoming sessions scheduled at this time.</p>
        @endforelse
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