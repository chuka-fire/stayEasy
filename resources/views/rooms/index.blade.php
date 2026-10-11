<x-site-layout title="Rooms">
    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm text-gray-600">
                <tr>
                    <th class="px-4 py-3">Number</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Price per night</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr class="border-t">
                        <td class="px-4 py-3">
                            <a href="{{ route('rooms.show', $room->id) }}" class="font-medium hover:underline">
                                {{ $room->number }}
                            </a>
                        </td>
                        <td class="px-4 py-3 capitalize">{{ $room->type }}</td>
                        <td class="px-4 py-3">{{ number_format($room->price_per_night, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-site-layout>
