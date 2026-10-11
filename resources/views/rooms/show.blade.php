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

    <a href="{{ route('rooms.index') }}" class="text-sm hover:underline">Back to rooms</a>
</x-site-layout>
