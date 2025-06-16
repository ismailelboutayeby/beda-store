<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧵 Designer - Incoming Orders
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-flash />

            @forelse ($orders as $order)
                <div class="bg-white rounded-lg shadow p-6 mb-4 hover:shadow-md transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-700">
                                Order #{{ $order->id }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                Product: <span class="font-medium">{{ $order->product->name }}</span>
                            </p>
                            <p class="text-sm text-gray-500">Client: {{ $order->client->name }}</p>
                            <span class="inline-block px-3 py-1 mt-2 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">
                                Status: {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('designer.orders.show', $order->id) }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                View
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white p-6 rounded shadow text-center text-gray-500">
                    No incoming orders at the moment.
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
