@extends('layouts.admin')

@section('dashboard')
    <h2>Incoming Orders (Pending Design)</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->product->name ?? 'N/A' }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <form action="{{ route('designer.orders.approve', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Approve</button>
                        </form>
                        <form action="{{ route('designer.orders.reject', $order->id) }}" method="POST" style="display:inline; margin-left: 5px;">
                            @csrf
                            <button type="submit">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
