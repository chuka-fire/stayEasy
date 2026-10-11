<x-site-layout title="Guests">
    <div class="mb-4">
        <a href="{{ route('guests.create') }}"
           class="inline-block bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
            New guest
        </a>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm text-gray-600">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guests as $guest)
                    <tr class="border-t">
                        <td class="px-4 py-3">
                            <a href="{{ route('guests.show', $guest->id) }}" class="font-medium hover:underline">
                                {{ $guest->name }}
                            </a>
                        </td>
                        <td class="px-4 py-3">{{ $guest->email }}</td>
                        <td class="px-4 py-3">{{ $guest->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-site-layout>
