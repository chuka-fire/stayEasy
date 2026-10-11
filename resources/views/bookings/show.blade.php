<x-site-layout title="Booking {{ $booking->id }}">
    <div class="bg-white rounded shadow p-6 mb-6">
        <dl class="grid grid-cols-2 gap-4">
            <dt class="text-sm text-gray-500">Room</dt>
            <dd>
                <a href="{{ route('rooms.show', $booking->room->id) }}" class="hover:underline">
                    {{ $booking->room->number }} ({{ $booking->room->type }})
                </a>
            </dd>

            <dt class="text-sm text-gray-500">Guest</dt>
            <dd>
                <a href="{{ route('guests.show', $booking->guest->id) }}" class="hover:underline">
                    {{ $booking->guest->name }}
                </a>
            </dd>

            <dt class="text-sm text-gray-500">Booked by</dt>
            <dd>{{ $booking->user->name }}</dd>

            <dt class="text-sm text-gray-500">Check in</dt>
            <dd>{{ $booking->check_in->format('d M Y') }}</dd>

            <dt class="text-sm text-gray-500">Check out</dt>
            <dd>{{ $booking->check_out->format('d M Y') }}</dd>

            <dt class="text-sm text-gray-500">Total price</dt>
            <dd>{{ number_format($booking->total_price, 2) }}</dd>

            <dt class="text-sm text-gray-500">Status</dt>
            <dd class="capitalize">{{ str_replace('_', ' ', $booking->status) }}</dd>
        </dl>
    </div>

    <div class="flex items-center gap-3 mb-6">
        @if ($booking->status === 'booked')
            <form method="POST" action="{{ route('bookings.status', $booking->id) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="checked_in">

                <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Check in
                </button>
            </form>
        @endif

        @if ($booking->status === 'checked_in')
            <form method="POST" action="{{ route('bookings.status', $booking->id) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="checked_out">

                <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Check out
                </button>
            </form>
        @endif

        @if (auth()->user()->isManager() && $booking->status !== 'cancelled' && $booking->status !== 'checked_out')
            <form method="POST" action="{{ route('bookings.status', $booking->id) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="cancelled">

                <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-600">
                    Cancel booking
                </button>
            </form>
        @endif
    </div>

    <a href="{{ route('bookings.index') }}" class="text-sm hover:underline">Back to bookings</a>
</x-site-layout>
