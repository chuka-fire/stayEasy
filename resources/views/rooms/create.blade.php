<x-site-layout title="New room">
    <form method="POST" action="{{ route('rooms.store') }}" class="bg-white rounded shadow p-6 max-w-md">
        @csrf

        <label class="block mb-4">
            <span class="block text-sm text-gray-600 mb-1">Number</span>
            <input type="text" name="number" class="w-full border rounded px-3 py-2">
        </label>

        <label class="block mb-4">
            <span class="block text-sm text-gray-600 mb-1">Type</span>
            <select name="type" class="w-full border rounded px-3 py-2">
                <option value="single">Single</option>
                <option value="double">Double</option>
                <option value="suite">Suite</option>
            </select>
        </label>

        <label class="block mb-6">
            <span class="block text-sm text-gray-600 mb-1">Price per night</span>
            <input type="number" step="0.01" name="price_per_night" class="w-full border rounded px-3 py-2">
        </label>

        <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
            Save room
        </button>
    </form>
</x-site-layout>
