<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Your common styles here */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            background-color: #f8fafc;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            height: 72px;
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .logo img {
            display: block;
            transition: transform 0.2s ease;
        }

        .logo:hover img {
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
            /* Tighter gap for pill style */
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .nav-links a {
            text-decoration: none;
            color: #ffffff;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Hover effect: Subtle background highlight */
        .nav-links a:hover {
            color: #3b82f6;
            background-color: rgba(59, 130, 246, 0.08);
        }

        .icon-link {
            font-size: 1.1rem;
        }

        .logout {
            text-decoration: none;
            color: #ef4444;
            /* Red for logout */
            font-size: 14px;
            font-weight: 600;
            padding: 8px 16px;
            border: 1px solid transparent;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .logout:hover {
            background: rgba(239, 68, 68, 0.05);
            border-color: rgba(239, 68, 68, 0.2);
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <!-- Navbar (appears on all pages using this layout) -->
    <nav class="navbar bg-gradient-to-br from-green-400 to-blue-400">
        <a href="/feed" class="logo">
            <img width="110" src="{{ asset('images/logo.png') }}" alt="App Logo">
        </a>

        <div class="nav-links">
            <a href="/feed"><i class="fa-solid fa-house-chimney"></i> Feed</a>
            <a href="/friends"><i class="fa-solid fa-user-group"></i> Friends</a>

            <a href="/chat/inbox"><i class="fa-solid fa-comment-dots"></i> Chat</a>

            <a href="/search" class="icon-link">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>

            <a href="/profile"><i class="fa-solid fa-circle-user"></i> Profile</a>
        </div>

        <div class="nav-actions">
            <a href="{{ route('logout') }}" class="logout"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>

        <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
            @csrf
        </form>
    </nav>

    <!-- This is where page content goes -->
    <main class="relative">
        {{-- <livewire:notification/> --}}
        {{ $slot }}
    </main>

    @stack('scripts')

    @vite(['resources/js/app.js'])

</body>

</html>
