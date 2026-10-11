<x-site-layout title="{{ $guest->name }}">
    <div class="bg-white rounded shadow p-6 mb-6">
        <dl class="grid grid-cols-2 gap-4">
            <dt class="text-sm text-gray-500">Name</dt>
            <dd>{{ $guest->name }}</dd>

            <dt class="text-sm text-gray-500">Email</dt>
            <dd>{{ $guest->email }}</dd>

            <dt class="text-sm text-gray-500">Phone</dt>
            <dd>{{ $guest->phone }}</dd>
        </dl>
    </div>

    <h2 class="text-lg font-bold mb-3">Booking history</h2>

    <div class="bg-white rounded shadow overflow-hidden mb-6">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm text-gray-600">
                <tr>
                    <th class="px-4 py-3">Room</th>
                    <th class="px-4 py-3">Check in</th>
                    <th class="px-4 py-3">Check out</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($guest->bookings as $booking)
                    <tr class="border-t">
                        <td class="px-4 py-3">
                            <a href="{{ route('bookings.show', $booking->id) }}" class="hover:underline">
                                {{ $booking->room->number }}
                            </a>
                        </td>
                        <td class="px-4 py-3">{{ $booking->check_in->format('d M Y') }}</td>
                        <td class="px-4 py-3">{{ $booking->check_out->format('d M Y') }}</td>
                        <td class="px-4 py-3 capitalize">{{ str_replace('_', ' ', $booking->status) }}</td>
                    </tr>
                @empty
                    <tr class="border-t">
                        <td class="px-4 py-3 text-gray-500" colspan="4">No bookings yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('guests.index') }}" class="text-sm hover:underline">Back to guests</a>
</x-site-layout>
