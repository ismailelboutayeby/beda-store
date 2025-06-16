<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📦 Warehouse - Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <x-flash />

        <div class="bg-white shadow-md rounded p-6 space-y-4">
            <h3 class="text-lg font-bold text-gray-700">Product Details</h3>
            <p><span class="font-semibold">Product:</span> {{ $order->product->name }}</p>
            <p><span class="font-semibold">Type:</span> {{ ucfirst($order->product->type) }}</p>
            <p><span class="font-semibold">Available Stock:</span> {{ $order->product->quantity }} units</p>

            <h3 class="text-lg font-bold text-gray-700 mt-6">Client Info</h3>
            <p><span class="font-semibold">Client Name:</span> {{ $order->client->name }}</p>
            <p><span class="font-semibold">Email:</span> {{ $order->client->email }}</p>

            <h3 class="text-lg font-bold text-gray-700 mt-6">Order Notes</h3>
            <p class="text-gray-600">{{ $order->notes ?? 'No notes provided.' }}</p>

            <div class="mt-8 flex gap-4">
                <form method="POST" action="{{ route('warehouse.orders.validate', $order->id) }}">
                    @csrf
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700 transition">
                        ✅ Approve (Stock Available)
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
