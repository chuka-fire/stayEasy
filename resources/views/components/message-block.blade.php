@if (session('message'))
    <div class="bg-green-100 border border-green-300 text-green-900 rounded px-4 py-3 mb-6">
        {{ session('message') }}
    </div>
@endif
