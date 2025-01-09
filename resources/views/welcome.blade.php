<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Site</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
            color: #333;
        }

        header {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }

        nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
        }

        a {
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        a:hover {
            background-color: #ff2d20;
            color: white;
        }

        main {
            text-align: center;
            padding: 50px 20px;
        }

        h1 {
            font-size: 3rem;
            color: #2d3748;
        }

        p {
            font-size: 1.125rem;
            color: #718096;
        }

        .logged-in {
            color: #38a169;
            font-size: 1.25rem;
        }

        footer {
            background-color: #ffffff;
            padding: 20px 0;
            text-align: center;
            color: #718096;
        }

        @media (max-width: 768px) {
            header {
                padding: 10px;
            }

            nav {
                flex-direction: column;
                align-items: flex-start;
            }

            a {
                margin-bottom: 10px;
            }

            main {
                padding: 30px 10px;
            }

            h1 {
                font-size: 2.5rem;
            }

            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    @if(Auth::user()->usertype == 'user')
                        <a href="{{ route('user.booking') }}" 
                           class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                            User Dashboard
                        </a>
                    @elseif(Auth::user()->usertype == 'admin')
                        <a href="{{ url('/admin') }}" 
                           class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                            Admin Dashboard
                        </a>
                    @endif
                    <a href="{{ route('logout') }}" 
                       class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
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

    <main class="py-16 px-4 text-center">
        <h1 class="text-3xl font-semibold text-gray-800">Welcome to the Booking Site</h1>
        <p class="mt-4 text-lg text-gray-600">Manage your bookings or sign in to access your dashboard.</p>

        @auth
            <p class="mt-4 text-xl text-green-600">
                You are logged in as {{ Auth::user()->name }}.
            </p>
        @else
            <p class="mt-4 text-xl text-gray-600">
                Please log in or register to access your bookings.
            </p>
        @endauth
    </main>

    <footer class="py-10 text-center text-gray-500">
        <p>&copy; {{ date('Y') }} Booking Site. All rights reserved.</p>
    </footer>
</body>
</html>
