@extends('layouts.admin')

@section('dashboard')
<div class="dashboard-cards" style="display: flex; gap: 2rem; flex-wrap: wrap;">
    <div class="card">
        <h3>Total Orders</h3>
        <p>{{ $ordersCount }}</p>
    </div>
    <div class="card">
        <h3>Stock Level</h3>
        <p>{{ $stockLevel }}</p>
    </div>
    <div class="card">
        <h3>Pending Deliveries</h3>
        <p>{{ $pendingDeliveries }}</p>
    </div>
    <div class="card">
        <h3>Total Invoices</h3>
        <p>{{ $invoicesCount }}</p>
    </div>
</div>

<div style="margin-top: 3rem;">
    <canvas id="ordersChart" width="400" height="150"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Orders', 'Stock', 'Pending Deliveries', 'Invoices'],
            datasets: [{
                label: 'Stats',
                data: [{{ $ordersCount }}, {{ $stockLevel }}, {{ $pendingDeliveries }}, {{ $invoicesCount }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(75, 192, 192, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
