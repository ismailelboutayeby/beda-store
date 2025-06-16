@extends('layouts.admin')

@section('dashboard')
    <h2>Warehouse Orders</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Product</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->client->name ?? 'N/A' }}</td>
                    <td>{{ $order->product->name ?? 'N/A' }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <form action="{{ route('warehouse.orders.validate', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Validate</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
