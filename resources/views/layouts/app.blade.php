{{-- Copilot: Remove the default Laravel interface and create a clean custom layout.
- Remove all Laravel branding, logos, and default content.
- Instead, include a dual-navbar layout (use @include('components.navbar')).
- Wrap the main page content with @yield('content').
- Use TailwindCSS.
- This layout should look modern, clean, and fully responsive. --}}
{{-- Copilot: Do NOT use the Laravel welcome page or default Blade layout.
Only use the new layout with our navbar and custom styles. --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-init="$store.darkMode.init()" :class="{ 'dark': $store.darkMode.on }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beda Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-gray-900 text-black dark:text-white">
    @include('components.navbars.main')
    <main class="py-6 px-4">
        @yield('content')
    </main>
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
