<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center py-4 px-6">
            <h2 class="font-semibold text-3xl text-white leading-tight">
                {{ __('Create New Session') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-8 transition-all hover:shadow-xl">
                <form method="POST" action="{{ route('mentor.session.store') }}">
                    @csrf

                    <!-- Add the error messages right here -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <!-- Mentee Selection -->
                    <div class="mb-6">
                        <label for="mentee_id"
                            class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Select Mentee:
                        </label>
                        <select id="mentee_id" name="mentee_id"
                            class="w-full border rounded-lg px-4 py-3 text-gray-700 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required>
                            <option value="">-- Select a mentee --</option>
                            @foreach ($availableMentees as $mentee)
                                <option value="{{ $mentee->id }}">{{ $mentee->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Start Time -->
                    <div class="mb-6">
                        <label for="start_time"
                            class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Start Time:
                        </label>
                        <div class="relative">
                            <input type="text" id="start_time" name="start_time"
                                class="w-full border rounded-lg px-4 py-3 text-gray-700 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 flatpickr"
                                required>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Select the starting time for the session.
                            </p>
                        </div>
                    </div>

                    <!-- End Time -->
                    <div class="mb-6">
                        <label for="end_time" class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            End Time:
                        </label>
                        <div class="relative">
                            <input type="text" id="end_time" name="end_time"
                                class="w-full border rounded-lg px-4 py-3 text-gray-700 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 flatpickr"
                                required>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Select the ending time for the session.
                            </p>
                        </div>
                    </div>

                    <!-- Duration -->
                    <div class="mb-6">
                        <label for="duration" class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Duration (calculated):
                        </label>
                        <input type="number" id="duration" name="duration"
                            class="w-full border rounded-lg px-4 py-3 text-gray-700 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            readonly>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Duration is automatically calculated based on the selected start and end times.
                        </p>
                    </div>

                    <!-- Session Details -->
                    <div class="mb-6">
                        <label for="session_details"
                            class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Session Details & Resources:
                        </label>
                        <textarea id="session_details" name="session_details" rows="6"
                            class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 px-4 py-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 focus:border-indigo-500 focus:ring-indigo-500 placeholder:text-gray-400 dark:placeholder:text-gray-400 sm:text-sm"
                            placeholder="• Add session agenda&#10;• Include relevant website links&#10;• List learning resources&#10;• Share preparation materials"></textarea>
                        <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                            Add details about the session, including any preparation materials, links to resources, or
                            specific topics to be covered. Markdown formatting is supported.
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition transform hover:scale-105">
                            Create Session
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Flatpickr Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const startPicker = flatpickr("#start_time", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: "today",
                onChange: calculateDuration,
            });

            const endPicker = flatpickr("#end_time", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: "today",
                onChange: calculateDuration,
            });

            function calculateDuration() {
                const startTime = startPicker.selectedDates[0];
                const endTime = endPicker.selectedDates[0];

                if (startTime && endTime) {
                    const duration = (endTime - startTime) / (1000 * 60); // Convert to minutes
                    document.getElementById("duration").value = duration > 0 ? duration : 0;
                }
            }

            // Show Toastr notification for success messages
            @if (session('status'))
                toastr.success("{{ session('status') }}", "Success", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                });
            @endif
        });
    </script>

    <!-- Toastr CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</x-app-layout>
