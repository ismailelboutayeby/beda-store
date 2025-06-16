<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧰 Atelier – Manage Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <x-flash />

        <div class="bg-white shadow-md rounded p-6 space-y-6">
            <div>
                <h3 class="text-lg font-bold text-gray-700">Product Information</h3>
                <p><span class="font-semibold">Product:</span> {{ $order->product->name }}</p>
                <p><span class="font-semibold">Type:</span> {{ $order->product->type }}</p>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-700">Client Information</h3>
                <p><span class="font-semibold">Client:</span> {{ $order->client->name }} ({{ $order->client->email }})</p>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-700">Assign a Production Task</h3>
                <form method="POST" action="{{ route('atelier.orders.assign.store', $order->id) }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" for="assigned_to">
                            Assign to Worker
                        </label>
                        <select name="assigned_to" id="assigned_to" required class="mt-1 block w-full rounded border-gray-300">
                            <option value="">Select a user</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" for="description">
                            Task Description
                        </label>
                        <textarea name="description" id="description" rows="4" required class="mt-1 block w-full border-gray-300 rounded"></textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow">
                        ➕ Assign Task
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
