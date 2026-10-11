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
            <a href="{{ url('/') }}" class="text-xl font-bold">StayEasy</a>
        </div>
    </header>

    <main class="flex-1 max-w-5xl w-full mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">{{ $title }}</h1>

        {{ $slot }}
    </main>

    <footer class="bg-white border-t">
        <div class="max-w-5xl mx-auto px-4 py-4 text-sm text-gray-500">
            StayEasy — hotel management
        </div>
    </footer>
</body>
</html>
