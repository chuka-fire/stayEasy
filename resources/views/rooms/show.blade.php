<x-site-layout title="Room {{ $room->number }}">
    <div class="bg-white rounded shadow p-6 mb-6">
        <dl class="grid grid-cols-2 gap-4">
            <dt class="text-sm text-gray-500">Number</dt>
            <dd>{{ $room->number }}</dd>

            <dt class="text-sm text-gray-500">Type</dt>
            <dd class="capitalize">{{ $room->type }}</dd>

            <dt class="text-sm text-gray-500">Price per night</dt>
            <dd>{{ number_format($room->price_per_night, 2) }}</dd>
        </dl>
    </div>

    @if (auth()->user()->isManager())
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('rooms.edit', $room->id) }}"
               class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
                Edit room
            </a>

            <form method="POST" action="{{ route('rooms.destroy', $room->id) }}">
                @csrf
                @method('DELETE')

                <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-600">
                    Delete room
                </button>
            </form>
        </div>
    @endif

    <a href="{{ route('rooms.index') }}" class="text-sm hover:underline">Back to rooms</a>
</x-site-layout>
