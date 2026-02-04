<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <style>
        /* Your common styles here */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar styles */
        .navbar {
            background: linear-gradient(135deg, #4ade80 0%, #3b82f6 100%);
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 12px;
            font-weight: 500;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <!-- Navbar (appears on all pages using this layout) -->
    <nav class="navbar">
        <a href="dashboard" class="w-[30%]"><img class="logo" width="100px" src="{{ asset('images/logo.png') }}" alt="App Logo"></a>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full mx-20">
            <div class="py-1 px-1">
                <div class="flex gap-4">
                    <input type="text" name="username" placeholder="Search users by name"
                        class="flex-1 px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition">
                    <button id="searchBtn"
                        class="bg-gradient-to-r from-green-400 to-blue-500 text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition">
                        Search
                    </button>
                </div>
            </div>
        </div>

        <div class="nav-links w-[50%]">
            <a href="/feed">Feed</a>
            <a href="/dashboard">Dashboard</a>
            <a href="/profile">Profile</a>
            <a href="#{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                @csrf
            </form>

        </div>
    </nav>

    <!-- This is where page content goes -->
    <main>
        {{ $slot }}
    </main>

    @stack('scripts')

    @vite(['resources/js/dashboard.js'])

</body>

</html>
