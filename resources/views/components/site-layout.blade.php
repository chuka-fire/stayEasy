<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} — StayEasy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">
    <header class="bg-white shadow">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('welcome') }}" class="text-xl font-bold">StayEasy</a>

            <nav class="flex items-center gap-6 text-sm">
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                    <a href="{{ route('rooms.index') }}" class="hover:underline">Rooms</a>
                    <a href="{{ route('guests.index') }}" class="hover:underline">Guests</a>
                    <a href="{{ route('bookings.index') }}" class="hover:underline">Bookings</a>

                    <span class="text-gray-500">{{ auth()->user()->name }}</span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="hover:underline">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Log in</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="flex-1 max-w-5xl w-full mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">{{ $title }}</h1>

        <x-message-block />

        {{ $slot }}
    </main>

    <footer class="bg-white border-t">
        <div class="max-w-5xl mx-auto px-4 py-4 text-sm text-gray-500">
            StayEasy — hotel management
        </div>
    </footer>
</body>
</html>
