<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center py-4 px-6">
            <h2 class="font-semibold text-3xl text-white leading-tight">
                {{ __('Create New Session') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-8 transform transition-all hover:shadow-xl">
                <form method="POST" action="{{ route('mentor.session.store') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="mentee_id" class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Select Mentee:</label>
                        <select id="mentee_id" name="mentee_id" class="w-full border rounded-lg px-4 py-3 text-gray-700 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            <option value="">-- Select a mentee --</option>
                            @foreach($availableMentees as $mentee)
                                <option value="{{ $mentee->id }}">{{ $mentee->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="start_time" class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Start Time:</label>
                        <div class="relative">
                            <input type="datetime-local" id="start_time" name="start_time" class="w-full border rounded-lg px-4 py-3 text-gray-700 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 pl-10" required>
                            <span class="absolute inset-y-0 left-2 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a2 2 0 00-2 2v2H3a1 1 0 100 2h1v6H3a1 1 0 100 2h1v2a2 2 0 002 2h8a2 2 0 002-2v-2h1a1 1 0 100-2h-1V8h1a1 1 0 100-2h-1V4a2 2 0 00-2-2H6zm0 2h8v2H6V4zm1 6h6a1 1 0 110 2H7a1 1 0 010-2zm0 4h6a1 1 0 110 2H7a1 1 0 010-2z" /></svg>
                            </span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="end_time" class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">End Time:</label>
                        <div class="relative">
                            <input type="datetime-local" id="end_time" name="end_time" class="w-full border rounded-lg px-4 py-3 text-gray-700 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 pl-10" required>
                            <span class="absolute inset-y-0 left-2 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a2 2 0 00-2 2v2H3a1 1 0 100 2h1v6H3a1 1 0 100 2h1v2a2 2 0 002 2h8a2 2 0 002-2v-2h1a1 1 0 100-2h-1V8h1a1 1 0 100-2h-1V4a2 2 0 00-2-2H6zm0 2h8v2H6V4zm1 6h6a1 1 0 110 2H7a1 1 0 010-2zm0 4h6a1 1 0 110 2H7a1 1 0 010-2z" /></svg>
                            </span>
                        </div>
                    </div>

                    <div class="mb-6">
    <label for="session_details" class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">
        Session Details & Resources
    </label>
    <div class="mt-1">
        <div class="relative">
            <div class="flex rounded-md shadow-sm">
                <textarea
                    id="session_details"
                    name="session_details"
                    rows="6"
                    class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 px-4 py-3 
                           text-gray-700 dark:text-gray-300 dark:bg-gray-700 
                           focus:border-indigo-500 focus:ring-indigo-500 
                           placeholder:text-gray-400 dark:placeholder:text-gray-400 
                           sm:text-sm"
                    placeholder="• Add session agenda&#10;• Include relevant website links&#10;• List learning resources&#10;• Share preparation materials"
                ></textarea>
            </div>
        </div>
        <div class="mt-3 flex items-start space-x-2">
            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Add details about the session, including any preparation materials, links to resources, 
                or specific topics to be covered. Markdown formatting is supported.
            </p>
        </div>
    </div>
</div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition transform hover:scale-105">
                            Create Session
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>