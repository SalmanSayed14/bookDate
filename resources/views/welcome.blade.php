<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Site</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Add your stylesheets or any necessary head content here -->
</head>
<body>
    <!-- Navigation/Header -->
    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    @if(Auth::user()->usertype == 'user')
                        <!-- User Dashboard link -->
                        <a href="{{ route('user.booking') }}" 
                           class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                            User Dashboard
                        </a>
                    @elseif(Auth::user()->usertype == 'admin')
                        <!-- Admin Dashboard link -->
                        <a href="{{ url('/admin') }}" 
                           class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                            Admin Dashboard
                        </a>
                    @endif
                    <!-- Logout link -->
                    <a href="{{ route('logout') }}" 
                       class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <!-- Log in and Register links -->
                    <a href="{{ route('login') }}" 
                       class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Content Section -->
    <main class="py-16 px-4 text-center">
        <h1 class="text-3xl font-semibold text-gray-800">Welcome to the Booking Site</h1>
        <p class="mt-4 text-lg text-gray-600">Manage your bookings or sign in to access your dashboard.</p>

        <!-- If the user is logged in, show them a personalized message -->
        @auth
            <p class="mt-4 text-xl text-green-600">
                You are logged in as {{ Auth::user()->name }}.
            </p>
        @else
            <!-- Otherwise, show a call to action -->
            <p class="mt-4 text-xl text-gray-600">
                Please log in or register to access your bookings.
            </p>
        @endauth
    </main>

    <!-- Footer Section (Optional) -->
    <footer class="py-10 text-center text-gray-500">
        <p>&copy; {{ date('Y') }} Booking Site. All rights reserved.</p>
    </footer>
</body>
</html>
