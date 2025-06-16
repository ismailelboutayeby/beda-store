@extends('layouts.admin')

@section('dashboard')
    <h2>Assign Shipment Details</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('logistics.shipments.assign') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="driver_name">Driver Name:</label>
            <input type="text" name="driver_name" id="driver_name" required>
        </div>
        <div class="form-group">
            <label for="vehicle">Vehicle:</label>
            <input type="text" name="vehicle" id="vehicle" required>
        </div>
        <div class="form-group">
            <label for="tracking_link">Tracking Link (optional):</label>
            <input type="url" name="tracking_link" id="tracking_link">
        </div>
        <button type="submit">Assign Shipment</button>
    </form>
@endsection
