<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🚚 Logistics – Prepare Shipment for Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <x-flash />

        <div class="bg-white shadow-md rounded p-6 space-y-6">
            <div>
                <h3 class="text-lg font-bold text-gray-700">Product</h3>
                <p><span class="font-semibold">Name:</span> {{ $order->product->name }}</p>
                <p><span class="font-semibold">Client:</span> {{ $order->client->name }}</p>
            </div>

            <form method="POST" action="{{ route('logistics.orders.store', $order->id) }}">
                @csrf

                <div class="mb-4">
                    <label for="driver_name" class="block font-medium text-sm text-gray-700">Driver Name</label>
                    <input type="text" name="driver_name" id="driver_name" required
                           class="mt-1 block w-full border-gray-300 rounded shadow-sm" />
                </div>

                <div class="mb-4">
                    <label for="vehicle" class="block font-medium text-sm text-gray-700">Vehicle</label>
                    <input type="text" name="vehicle" id="vehicle" required
                           class="mt-1 block w-full border-gray-300 rounded shadow-sm" />
                </div>

                <div class="mb-4">
                    <label for="tracking_link" class="block font-medium text-sm text-gray-700">Tracking Link (optional)</label>
                    <input type="url" name="tracking_link" id="tracking_link"
                           class="mt-1 block w-full border-gray-300 rounded shadow-sm" />
                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                    ✅ Assign & Start Delivery
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
