<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Our Platform</title>

    <!-- Fonts and Scripts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1e2a38; /* Dark Navy Background */
            color: #ffffff; /* White Text */
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans antialiased overflow-x-hidden">

    <!-- Hero Section -->
    <div class="hero py-20 bg-gradient-to-br from-gray-800 to-gray-900 text-white text-center">
        <div>
            <h1 class="text-5xl font-bold mb-4">Welcome to Our Platform</h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto mb-8">
                Discover a world of personalized mentoring and coaching services that help you achieve your goals.
            </p>
            @if (Route::has('login'))
                <div class="mt-4 space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary bg-pink-500 text-white py-2 px-6 rounded-lg font-semibold hover:bg-pink-700 transition-all duration-300">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary bg-pink-500 text-white py-2 px-6 rounded-lg font-semibold hover:bg-pink-700 transition-all duration-300">Log In</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary ml-4 bg-pink-500 text-white py-2 px-6 rounded-lg font-semibold hover:bg-pink-700 transition-all duration-300">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>

    <!-- Features Section -->
    <div class="features flex flex-wrap gap-8 p-8 bg-gray-900 justify-center">
        <div class="feature flex-1 p-6 bg-gray-800 rounded-lg shadow-lg text-center transform transition-transform duration-300 hover:scale-105">
            <h3 class="text-2xl font-semibold text-pink-500 mb-2">Real-Time Communication</h3>
            <p class="text-gray-300">Engage with mentors and mentees through interactive chat and video sessions.</p>
        </div>
        <div class="feature flex-1 p-6 bg-gray-800 rounded-lg shadow-lg text-center transform transition-transform duration-300 hover:scale-105">
            <h3 class="text-2xl font-semibold text-pink-500 mb-2">Personalized Mentorship</h3>
            <p class="text-gray-300">Receive customized coaching plans designed to help you meet your specific objectives.</p>
        </div>
        <div class="feature flex-1 p-6 bg-gray-800 rounded-lg shadow-lg text-center transform transition-transform duration-300 hover:scale-105">
            <h3 class="text-2xl font-semibold text-pink-500 mb-2">Goal Tracking</h3>
            <p class="text-gray-300">Track your progress with structured goals, and get feedback to improve continuously.</p>
        </div>
        <div class="feature flex-1 p-6 bg-gray-800 rounded-lg shadow-lg text-center transform transition-transform duration-300 hover:scale-105">
            <h3 class="text-2xl font-semibold text-pink-500 mb-2">Secure Data</h3>
            <p class="text-gray-300">Experience safe and secure data management with privacy-focused features.</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-gray-800 text-gray-300 py-4 text-center">
        <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
        <p>&copy; 2024 Your Company. <a href="#" class="text-pink-500 hover:text-pink-700">Privacy Policy</a> | <a href="#" class="text-pink-500 hover:text-pink-700">Terms of Service</a></p>
    </footer>

    <script>
        // Optional JavaScript for interactivity or animations
        document.addEventListener('DOMContentLoaded', function() {
            // Example of simple hover effect or other dynamic actions
            const features = document.querySelectorAll('.feature');
            features.forEach(feature => {
                feature.addEventListener('mouseenter', () => {
                    feature.classList.add('scale-105');
                });
                feature.addEventListener('mouseleave', () => {
                    feature.classList.remove('scale-105');
                });
            });
        });
    </script>

</body>
</html>
