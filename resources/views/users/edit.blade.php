<x-site-layout title="Edit {{ $user->name }}">
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="bg-white rounded shadow p-6 max-w-md">
        @csrf
        @method('PUT')

        <label class="block mb-4">
            <span class="block text-sm text-gray-600 mb-1">Name</span>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded px-3 py-2">
            @error('name')
                <span class="block text-sm text-red-700 mt-1">{{ $message }}</span>
            @enderror
        </label>

        <label class="block mb-4">
            <span class="block text-sm text-gray-600 mb-1">Email</span>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-3 py-2">
            @error('email')
                <span class="block text-sm text-red-700 mt-1">{{ $message }}</span>
            @enderror
        </label>

        <label class="block mb-4">
            <span class="block text-sm text-gray-600 mb-1">New password</span>
            <input type="password" name="password" class="w-full border rounded px-3 py-2">
            <span class="block text-sm text-gray-500 mt-1">Leave empty to keep the current password.</span>
            @error('password')
                <span class="block text-sm text-red-700 mt-1">{{ $message }}</span>
            @enderror
        </label>

        <label class="flex items-center gap-2 mb-2">
            <input type="checkbox" name="is_staff" value="1" @checked(old('is_staff', $user->is_staff))>
            <span class="text-sm text-gray-600">Account is active</span>
        </label>

        <label class="flex items-center gap-2 mb-6">
            <input type="checkbox" name="is_manager" value="1" @checked(old('is_manager', $user->is_manager))>
            <span class="text-sm text-gray-600">This person is a manager</span>
        </label>

        <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
            Save changes
        </button>
    </form>
</x-site-layout>
