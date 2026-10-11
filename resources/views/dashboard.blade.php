<x-site-layout title="Dashboard">
    <p class="mb-6">Welcome back, {{ auth()->user()->name }}.</p>

    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <h2 class="text-lg font-bold mb-3">Checking in today</h2>

            <div class="bg-white rounded shadow overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-sm text-gray-600">
                        <tr>
                            <th class="px-4 py-3">Room</th>
                            <th class="px-4 py-3">Guest</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($arrivals as $booking)
                            <tr class="border-t">
                                <td class="px-4 py-3">
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="hover:underline">
                                        {{ $booking->room->number }}
                                    </a>
                                </td>
                                <td class="px-4 py-3">{{ $booking->guest->name }}</td>
                                <td class="px-4 py-3 capitalize">{{ str_replace('_', ' ', $booking->status) }}</td>
                            </tr>
                        @empty
                            <tr class="border-t">
                                <td class="px-4 py-3 text-gray-500" colspan="3">No arrivals today.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h2 class="text-lg font-bold mb-3">Checking out today</h2>

            <div class="bg-white rounded shadow overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-sm text-gray-600">
                        <tr>
                            <th class="px-4 py-3">Room</th>
                            <th class="px-4 py-3">Guest</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departures as $booking)
                            <tr class="border-t">
                                <td class="px-4 py-3">
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="hover:underline">
                                        {{ $booking->room->number }}
                                    </a>
                                </td>
                                <td class="px-4 py-3">{{ $booking->guest->name }}</td>
                                <td class="px-4 py-3 capitalize">{{ str_replace('_', ' ', $booking->status) }}</td>
                            </tr>
                        @empty
                            <tr class="border-t">
                                <td class="px-4 py-3 text-gray-500" colspan="3">No departures today.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-site-layout>
