@if (session('success'))
    <div class="mb-4 text-green-600 bg-green-100 border border-green-300 p-3 rounded shadow">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 text-red-600 bg-red-100 border border-red-300 p-3 rounded shadow">
        {{ session('error') }}
    </div>
@endif
