<x-site-layout title="Bookings">
    <div class="mb-4">
        <a href="{{ route('bookings.create') }}"
           class="inline-block bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
            New booking
        </a>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm text-gray-600">
                <tr>
                    <th class="px-4 py-3">Room</th>
                    <th class="px-4 py-3">Guest</th>
                    <th class="px-4 py-3">Check in</th>
                    <th class="px-4 py-3">Check out</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr class="border-t">
                        <td class="px-4 py-3">
                            <a href="{{ route('bookings.show', $booking->id) }}" class="font-medium hover:underline">
                                {{ $booking->room->number }}
                            </a>
                        </td>
                        <td class="px-4 py-3">{{ $booking->guest->name }}</td>
                        <td class="px-4 py-3">{{ $booking->check_in->format('d M Y') }}</td>
                        <td class="px-4 py-3">{{ $booking->check_out->format('d M Y') }}</td>
                        <td class="px-4 py-3 capitalize">{{ str_replace('_', ' ', $booking->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-site-layout>
