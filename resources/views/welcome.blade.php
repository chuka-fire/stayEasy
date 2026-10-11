<x-site-layout title="Welcome">
    <div class="bg-white rounded shadow p-6">
        <p class="mb-4">
            StayEasy is the front desk tool for our hotel. Staff manage guests, create
            bookings, and check people in and out. Managers also look after rooms and
            staff accounts.
        </p>

        <p class="text-sm text-gray-500 mb-6">
            Accounts are created by a manager. There is no public sign-up.
        </p>

        <a href="{{ route('login') }}"
           class="inline-block bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
            Log in
        </a>
    </div>
</x-site-layout>
