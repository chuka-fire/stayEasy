<x-site-layout title="New staff account">
    <form method="POST" action="{{ route('users.store') }}" class="bg-white rounded shadow p-6 max-w-md">
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

        <label class="block mb-4">
            <span class="block text-sm text-gray-600 mb-1">Password</span>
            <input type="password" name="password" class="w-full border rounded px-3 py-2">
            @error('password')
                <span class="block text-sm text-red-700 mt-1">{{ $message }}</span>
            @enderror
        </label>

        <label class="flex items-center gap-2 mb-6">
            <input type="checkbox" name="is_manager" value="1" @checked(old('is_manager'))>
            <span class="text-sm text-gray-600">This person is a manager</span>
        </label>

        <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
            Create account
        </button>
    </form>
</x-site-layout>
