@extends('layouts.admin')

@section('dashboard')
    <h2>Invoices</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->order_id }}</td>
                    <td>{{ $invoice->amount }}</td>
                    <td>{{ $invoice->payment_status }}</td>
                    <td>
                        <form action="{{ route('invoices.markPaid', $invoice->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Mark as Paid</button>
                        </form>
                        <form action="{{ route('invoices.markFailed', $invoice->id) }}" method="POST" style="display:inline; margin-left: 5px;">
                            @csrf
                            <button type="submit">Mark as Failed</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
