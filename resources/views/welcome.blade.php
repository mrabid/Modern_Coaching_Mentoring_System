<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        MentorConnect
    </title>

    <!-- Meta icon -->
    <link rel="icon" href="https://img.icons8.com/?size=100&id=80349&format=png&color=000000" type="image/x-icon">

    <!-- Theme Script -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        .gradient-text {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
        }
    </style>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-200">
    <!-- Navigation -->
    <nav
        class="fixed w-full bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm z-50 border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl font-bold gradient-text">MentorConnect</span>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle Button -->
                    <button id="theme-toggle"
                        class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200">
                        <!-- Sun icon -->
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z">
                            </path>
                        </svg>
                        <!-- Moon icon -->
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </button>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Log
                                in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition">Get
                                    Started</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto text-center">
            <h1
                class="text-5xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-blue-600 to-blue-400 text-transparent bg-clip-text">
                Connect with Professional Mentors
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-10">
                Accelerate your professional growth with personalized mentorship from industry experts.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Join as Mentee
                </a>
                <a href="{{ route('register') }}"
                    class="px-8 py-3 bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 border-2 border-blue-600 dark:border-blue-400 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Become a Mentor
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 px-4 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div
                class="p-8 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 transform transition-all duration-300 hover:scale-105">
                <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-2">1000+</div>
                <div class="text-gray-600 dark:text-gray-300">Active Mentors</div>
            </div>
            <div
                class="p-8 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 transform transition-all duration-300 hover:scale-105">
                <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-2">5000+</div>
                <div class="text-gray-600 dark:text-gray-300">Successful Sessions</div>
            </div>
            <div
                class="p-8 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 transform transition-all duration-300 hover:scale-105">
                <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-2">95%</div>
                <div class="text-gray-600 dark:text-gray-300">Satisfaction Rate</div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-4 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900 dark:text-white">Why Choose MentorConnect?
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="p-6 rounded-xl bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-400 transition-all duration-300">
                    <h3 class="text-xl font-semibold mb-4 text-blue-600 dark:text-blue-400">Verified Mentors</h3>
                    <p class="text-gray-600 dark:text-gray-300">All our mentors go through a rigorous verification
                        process to ensure quality guidance.</p>
                </div>
                <div
                    class="p-6 rounded-xl bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-400 transition-all duration-300">
                    <h3 class="text-xl font-semibold mb-4 text-blue-600 dark:text-blue-400">Flexible Scheduling</h3>
                    <p class="text-gray-600 dark:text-gray-300">Book sessions that fit your schedule with our
                        easy-to-use calendar system.</p>
                </div>
                <div
                    class="p-6 rounded-xl bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-400 transition-all duration-300">
                    <h3 class="text-xl font-semibold mb-4 text-blue-600 dark:text-blue-400">Track Progress</h3>
                    <p class="text-gray-600 dark:text-gray-300">Monitor your growth with detailed progress tracking and
                        milestone achievements.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 bg-blue-600 dark:bg-blue-700">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6 text-white">Ready to Start Your Growth Journey?</h2>
            <p class="text-blue-100 mb-8">Join thousands of professionals who are accelerating their careers with
                MentorConnect.</p>
            <a href="{{ route('register') }}"
                class="inline-block px-8 py-3 bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                Get Started Now
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">MentorConnect</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Empowering professional growth through
                        mentorship.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Quick Links</h4>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">About
                                Us</a></li>
                        <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Find a
                                Mentor</a></li>
                        <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Become a
                                Mentor</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Resources</h4>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Blog</a>
                        </li>
                        <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">FAQ</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-blue-600 dark:hover:text-blue-400 transition">Support</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Legal</h4>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Privacy
                                Policy</a></li>
                        <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Terms of
                                Service</a></li>
                    </ul>
                </div>
            </div>
            <div
                class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-800 text-center text-gray-600 dark:text-gray-400 text-sm">
                <p>© {{ date('Y') }} MentorConnect. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Theme Toggle Script -->
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            // Toggle icons
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // If is set in localStorage
            if (localStorage.theme === 'dark') {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });

        // Watch for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            if (!('theme' in localStorage)) {
                if (e.matches) {
                    document.documentElement.classList.add('dark');
                    themeToggleLightIcon.classList.remove('hidden');
                    themeToggleDarkIcon.classList.add('hidden');
                } else {
                    document.documentElement.classList.remove('dark');
                    themeToggleLightIcon.classList.add('hidden');
                    themeToggleDarkIcon.classList.remove('hidden');
                }
            }
        });
    </script>
</body>

</html>
