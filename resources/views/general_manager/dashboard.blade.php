@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">General Manager Dashboard</h1>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-500">Total Users</p>
            <h2 class="text-2xl font-bold">{{ $stats['total_users'] }}</h2>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-500">Total Orders</p>
            <h2 class="text-2xl font-bold">{{ $stats['total_orders'] }}</h2>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-500">Pending Orders</p>
            <h2 class="text-2xl font-bold">{{ $stats['pending_orders'] }}</h2>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="font-semibold mb-4">Invoice Status</h3>
            <canvas id="invoiceChart"></canvas>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="font-semibold mb-4">Order Status Overview</h3>
            <canvas id="orderChart"></canvas>
        </div>
    </div>

    <!-- Low Stock Products -->
    <div class="bg-white p-6 rounded shadow">
        <h3 class="font-semibold mb-4 text-red-600">Low Stock Products (≤ 10)</h3>
        <ul>
            @forelse($stats['products_low_stock'] as $product)
                <li class="border-b py-2">{{ $product->name }} – {{ $product->quantity }} units left</li>
            @empty
                <li class="text-gray-500">All products in stock.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const invoiceChart = document.getElementById('invoiceChart');
new Chart(invoiceChart, {
    type: 'pie',
    data: {
        labels: ['Pending', 'Paid', 'Failed'],
        datasets: [{
            label: 'Invoices',
            data: [{{ $stats['unpaid_invoices'] }}, 10, 2], // you can update with real values later
            backgroundColor: ['#facc15', '#22c55e', '#ef4444']
        }]
    }
});

const orderChart = document.getElementById('orderChart');
new Chart(orderChart, {
    type: 'bar',
    data: {
        labels: ['Pending Design', 'Validated Design', 'Validated Warehouse', 'In Production', 'Shipped'],
        datasets: [{
            label: 'Orders',
            data: [12, 8, 5, 10, {{ $stats['pending_orders'] }}], // static/fake for now
            backgroundColor: '#3b82f6'
        }]
    }
});
</script>
@endsection
