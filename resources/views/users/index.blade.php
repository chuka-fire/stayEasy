<x-site-layout title="Staff">
    <div class="mb-4">
        <a href="{{ route('users.create') }}"
           class="inline-block bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
            New staff account
        </a>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm text-gray-600">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Active</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-t">
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">{{ $user->isManager() ? 'Manager' : 'Staff' }}</td>
                        <td class="px-4 py-3">{{ $user->isStaff() ? 'Yes' : 'No' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3 justify-end">
                                <a href="{{ route('users.edit', $user->id) }}" class="text-sm hover:underline">Edit</a>

                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-sm text-red-700 hover:underline">Remove</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-site-layout>
