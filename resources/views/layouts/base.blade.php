<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="header">
        @yield('header')
    </div>
    <div class="sidebar">
        @yield('sidebar')
    </div>
    <div class="dashboard">
        @yield('dashboard')
    </div>
</body>
</html>
