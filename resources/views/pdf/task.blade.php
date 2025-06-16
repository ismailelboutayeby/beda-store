<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task #{{ $task->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 10px; }
        .section { margin-top: 20px; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <div class="title">Production Task #{{ $task->id }}</div>

    <div class="section">
        <div><span class="label">Assigned To:</span> {{ $task->user->name }}</div>
        <div><span class="label">Order ID:</span> {{ $task->order->id }}</div>
        <div><span class="label">Description:</span></div>
        <div>{{ $task->description }}</div>
    </div>

    <div class="section">
        <div><span class="label">Progress:</span> {{ $task->progress }}%</div>
        <div><span class="label">Status:</span> {{ ucfirst($task->status) }}</div>
    </div>
</body>
</html>
