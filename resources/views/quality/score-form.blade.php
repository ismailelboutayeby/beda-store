@extends('layouts.admin')

@section('dashboard')
    <h2>Quality Assessment</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('quality.score.submit', $order->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="score">Quality Score (1-10):</label>
            <input type="number" name="score" id="score" min="1" max="10" required>
        </div>
        <div class="form-group">
            <label for="notes">Notes (optional):</label>
            <textarea name="notes" id="notes" rows="3"></textarea>
        </div>
        <button type="submit">Submit Quality Score</button>
    </form>
@endsection
