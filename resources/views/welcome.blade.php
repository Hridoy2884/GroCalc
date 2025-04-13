<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Smart Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center px-4 transition-colors duration-300 bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 dark:text-white">

    <div class="absolute top-5 right-5">
        <button id="theme-toggle" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-1 rounded-md shadow-md text-sm hover:opacity-90 transition">
            🌙 Dark Mode
        </button>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-6 sm:p-10 w-full max-w-xl text-center">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white mb-3">GroCalc</h1>
        <p class="text-gray-600 dark:text-gray-300 text-sm sm:text-base mb-6">
            A simple tool to calculate totals, store records, and download PDF.
        </p>

        @auth
            <h2 class="text-lg sm:text-xl font-semibold text-green-700 dark:text-green-400 mb-4">
                Welcome, {{ Auth::user()->name }}!
            </h2>
            <a href="{{ route('dashboard') }}" class="block w-full sm:inline-block bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition mb-3 sm:mb-0">
                Go to Dashboard
            </a>
        @else
            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-4">
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">Login</a>
                <a href="{{ route('register') }}" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition">Register</a>
            </div>
        @endauth

        <p id="login-warning" class="text-red-600 dark:text-red-400 mt-4 hidden text-sm">⚠️ Please login or register to use the calculator.</p>
    </div>

    <script>
        // Dark mode toggle logic
        const toggleBtn = document.getElementById('theme-toggle');
        const currentTheme = localStorage.getItem('theme');
        const isDark = currentTheme === 'dark';

        const applyTheme = (dark) => {
            document.documentElement.classList.toggle('dark', dark);
            toggleBtn.textContent = dark ? '☀ Light Mode' : '🌙 Dark Mode';
        };

        applyTheme(isDark); // Apply saved theme on load

        toggleBtn.addEventListener('click', () => {
            const darkMode = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', darkMode ? 'dark' : 'light');
            toggleBtn.textContent = darkMode ? '☀ Light Mode' : '🌙 Dark Mode';
        });

        // Show warning if not logged in and user interacts with input
        const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
        const warning = document.getElementById('login-warning');

        if (!isLoggedIn) {
            document.addEventListener('focusin', e => {
                if (e.target.tagName === 'INPUT') {
                    warning.classList.remove('hidden');
                }
            });
        }
    </script>

</body>
</html>
