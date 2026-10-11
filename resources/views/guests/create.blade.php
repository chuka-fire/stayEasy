<x-site-layout title="New guest">
    <form method="POST" action="{{ route('guests.store') }}" class="bg-white rounded shadow p-6 max-w-md">
        @csrf

        <label class="block mb-4">
            <span class="block text-sm text-gray-600 mb-1">Name</span>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2">
            @error('name')
                <span class="block text-sm text-red-700 mt-1">{{ $message }}</span>
            @enderror
        </label>

        <label class="block mb-4">
            <span class="block text-sm text-gray-600 mb-1">Email</span>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2">
            @error('email')
                <span class="block text-sm text-red-700 mt-1">{{ $message }}</span>
            @enderror
        </label>

        <label class="block mb-6">
            <span class="block text-sm text-gray-600 mb-1">Phone</span>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded px-3 py-2">
            @error('phone')
                <span class="block text-sm text-red-700 mt-1">{{ $message }}</span>
            @enderror
        </label>

        <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
            Save guest
        </button>
    </form>
</x-site-layout>
