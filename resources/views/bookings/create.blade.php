<x-site-layout title="New booking">
    <form method="POST" action="{{ route('bookings.store') }}" class="bg-white rounded shadow p-6 max-w-md">
        @csrf

        <label class="block mb-4">
            <span class="block text-sm text-gray-600 mb-1">Room</span>
            <select name="room_id" class="w-full border rounded px-3 py-2">
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" @selected(old('room_id') == $room->id)>
                        {{ $room->number }} ({{ $room->type }}) — {{ number_format($room->price_per_night, 2) }} per night
                    </option>
                @endforeach
            </select>
            @error('room_id')
                <span class="block text-sm text-red-700 mt-1">{{ $message }}</span>
            @enderror
        </label>

        <label class="block mb-4">
            <span class="block text-sm text-gray-600 mb-1">Guest</span>
            <select name="guest_id" class="w-full border rounded px-3 py-2">
                @foreach ($guests as $guest)
                    <option value="{{ $guest->id }}" @selected(old('guest_id') == $guest->id)>
                        {{ $guest->name }}
                    </option>
                @endforeach
            </select>
            @error('guest_id')
                <span class="block text-sm text-red-700 mt-1">{{ $message }}</span>
            @enderror
        </label>

        <label class="block mb-4">
            <span class="block text-sm text-gray-600 mb-1">Check in</span>
            <input type="date" name="check_in" value="{{ old('check_in') }}" class="w-full border rounded px-3 py-2">
            @error('check_in')
                <span class="block text-sm text-red-700 mt-1">{{ $message }}</span>
            @enderror
        </label>

        <label class="block mb-6">
            <span class="block text-sm text-gray-600 mb-1">Check out</span>
            <input type="date" name="check_out" value="{{ old('check_out') }}" class="w-full border rounded px-3 py-2">
            @error('check_out')
                <span class="block text-sm text-red-700 mt-1">{{ $message }}</span>
            @enderror
        </label>

        <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
            Save booking
        </button>
    </form>
</x-site-layout>
