<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center py-4 px-6 bg-blue-600">
            <h2 class="font-semibold text-3xl text-white leading-tight">
                {{ __('Mentee Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Message -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg p-6 transform hover:scale-105 transition duration-300 ease-in-out">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Welcome, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    This is your dashboard where you can view your upcoming sessions, track your learning progress, and access important resources.
                </p>
            </div>

            <!-- Upcoming Sessions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Upcoming Sessions</h3>
                <ul class="mt-4 space-y-2 text-gray-600 dark:text-gray-400 list-disc list-inside">
                    <!-- Dynamically populated list items could be here -->
                    <li>Session with Mentor on Nov 15th at 3:00 PM</li>
                    <li>Session with Mentor on Nov 18th at 1:00 PM</li>
                    <li>Session with Mentor on Nov 20th at 5:00 PM</li>
                </ul>
            </div>

            <!-- Progress Tracking -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Your Progress</h3>
                <div class="mt-4 space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700">
                            <div class="bg-blue-600 h-6 rounded-full" style="width: 75%;"></div>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300 font-bold">75%</span>
                    </div>
                </div>
            </div>

            <!-- Resources Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Resources</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Here are some helpful links and resources for your learning journey.
                </p>
                <ul class="mt-4 space-y-2 text-blue-500 dark:text-blue-400 list-disc list-inside">
                    <li><a href="#" class="hover:underline">Learning Materials</a></li>
                    <li><a href="#" class="hover:underline">Mentee Handbook</a></li>
                    <li><a href="#" class="hover:underline">Session Guidelines</a></li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
