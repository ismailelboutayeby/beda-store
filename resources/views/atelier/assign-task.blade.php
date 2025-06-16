@extends('layouts.admin')

@section('dashboard')
    <h2>Assign Task to Atelier Worker</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('atelier.tasks.assign') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="worker_id">Select Worker:</label>
            <select name="worker_id" id="worker_id" required>
                @foreach($workers as $worker)
                    <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Task Description:</label>
            <textarea name="description" id="description" rows="3" required></textarea>
        </div>
        <button type="submit">Assign Task</button>
    </form>
@endsection
