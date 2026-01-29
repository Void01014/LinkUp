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

        @yield('styles');
    </style>
</head>
<body>
    <!-- Navbar (appears on all pages using this layout) -->
    <nav class="navbar">
        <div class="logo">My App</div>
        <div class="nav-links">
            <a href="/dashboard">Dashboard</a>
            <a href="/profile">Profile</a>
            <a href="/logout">Logout</a>
        </div>
    </nav>

    <!-- This is where page content goes -->
    <main>
        
    </main>

    <script>
        @yield('scripts')
    </script>
</body>
</html>