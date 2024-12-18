<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center py-4 px-6 bg-gradient-to-r">
            <h2 class="font-semibold text-3xl text-gray-900 dark:text-gray-100 leading-tight">
                {{ __('Mentee Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 text-gray-900 dark:text-gray-100">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <!-- Welcome Message Section -->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <!-- Welcome Message Section -->
                    <div id="welcome-message" class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl p-6">
                        <div class="flex items-center space-x-4">
                            <div
                                class="bg-blue-600 rounded-full h-14 w-14 flex items-center justify-center text-white shadow-lg">
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
                                    <span id="current-time"
                                        class="text-sm font-medium text-blue-600 dark:text-blue-400"></span>
                                    <span class="text-gray-400 dark:text-gray-500">•</span>
                                    <span id="current-date" class="text-sm text-gray-600 dark:text-gray-400"></span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 mt-2">
                                    Here, you can explore available mentors, schedule sessions, and track your learning
                                    journey.
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



                    <!-- Upcoming Sessions -->

                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg p-6 transition duration-300 hover:shadow-xl">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">📅 Upcoming Sessions</h3>

                        @if ($upcomingSessions->isEmpty())
                            <p class="text-gray-600 dark:text-gray-400 mt-4">No upcoming sessions scheduled.</p>
                        @else
                            <ul class="mt-4 space-y-4">
                                @foreach ($upcomingSessions as $session)
                                    <li
                                        class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-shadow border">
                                        <div class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            Session with {{ $session->mentor->name }}
                                        </div>
                                        <div class="mt-1 text-gray-500 dark:text-gray-400">
                                            <span class="font-medium">Date:</span>
                                            {{ \Carbon\Carbon::parse($session->start_time)->format('F jS, Y') }}
                                        </div>
                                        <div class="text-gray-500 dark:text-gray-400">
                                            <span class="font-medium">Time:</span>
                                            {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }}
                                        </div>
                                        <div class="text-gray-500 dark:text-gray-400">
                                            <span class="font-medium">Duration:</span> {{ $session->duration }} minutes
                                        </div>
                                        <div class="mt-2 text-gray-600 dark:text-gray-300">
                                            <span class="font-medium">Resource:</span> {{ $session->session_details }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        @endif
                    </div>



                    <!-- Mentor Invite Section -->

                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg p-6 transition duration-300 hover:shadow-xl">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">👥 Invite Mentor</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">
                            Find mentors based on their expertise and invite them to create a session.
                        </p>

                        <!-- Filter Section -->
                        <form class="mt-6 space-y-4" id="mentor-filter-form">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <!-- Expertise Dropdown -->
                                <div class="flex-grow">
                                    <label for="expertise"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expertise</label>
                                    <select id="expertise" name="expertise"
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value="">Select Expertise</option>
                                        <option value="AI">Artificial Intelligence</option>
                                        <option value="WebDev">Web Development</option>
                                        <option value="DataScience">Data Science</option>
                                        <option value="CyberSec">Cybersecurity</option>
                                        <!-- Add more options dynamically if needed -->
                                    </select>
                                </div>

                                <!-- Search Button -->
                                <div class="self-end">
                                    <button type="button" id="filter-button"
                                        class="w-full sm:w-auto bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Results Section -->
                        <div id="mentor-results" class="mt-8">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Search Results</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                                <!-- Mentor Cards Will Be Injected Dynamically -->
                            </div>
                        </div>
                    </div>


                    <!-- Resource Management -->
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg p-6 transition duration-300 hover:shadow-xl">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">📚 Manage Resources</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">
                            Easily access and manage the resources you share with your mentees.
                        </p>
                        <ul class="mt-4 space-y-2 text-blue-500 dark:text-blue-400 list-disc list-inside">
                            <li><a href="#" class="hover:underline">Upload New Resources</a></li>
                            <li><a href="#" class="hover:underline">View All Resources</a></li>
                            <li><a href="#" class="hover:underline">Mentee Guidelines</a></li>
                        </ul>
                    </div>









                    <!-- Chart.js Script for Progress Chart -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        const ctx = document.getElementById('progressChart').getContext('2d');
                        const progressChart = new Chart(ctx, {
                            type: 'bar', // Use 'line' or 'bar' as per preference
                            data: {
                                labels: ['Session 1', 'Session 2', 'Session 3', 'Session 4', 'Session 5'],
                                datasets: [{
                                    label: 'Progress (%)',
                                    data: [75, 85, 90, 60, 95], // Replace these with dynamic values as needed
                                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 2,
                                    borderRadius: 8,
                                    barPercentage: 0.8,
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        max: 100,
                                        title: {
                                            display: true,
                                            text: 'Progress (%)'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return context.parsed.y + '%';
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    </script>
</x-app-layout>
