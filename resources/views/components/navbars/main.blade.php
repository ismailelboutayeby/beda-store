<!-- Top Navbar -->
<div class="bg-white/90 dark:bg-gray-900/90 border-b shadow-lg backdrop-blur-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-0 py-6 flex items-center">
        <!-- Left: Logo -->
        <div class="flex items-center absolute left-0 pl-6" style="margin-right:1.5rem; position:relative;">
            <img src="{{ asset('images/Beda-logo_Black.png') }}" alt="Beda Logo" class="h-6 w-auto drop-shadow-md rounded-full bg-white p-1 transition-transform duration-200 hover:scale-110">
        </div>
        <!-- Center: Pretty Search Bar -->
        <div class="flex-1 flex justify-start">
            <div class="relative w-full max-w-xs">
                <input type="text" placeholder="Rechercher..."
                    class="w-full py-2 pl-5 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-400 hover:ring-blue-600 hover:shadow-md text-base bg-white dark:bg-white dark:text-gray-900 shadow-sm transition placeholder-gray-400">
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-400 dark:text-blue-300 hover:text-blue-600">
                    <!-- Heroicon: Magnifying Glass -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                    </svg>
                </span>
            </div>
        </div>

        <!-- Right: Account + Basket -->
        <div class="flex items-center space-x-4 ml-6">
            @auth
                <div x-data="{ open: false }" class="relative inline-block">
                    <button @click="open = !open" @keydown.escape="open = false" :aria-expanded="open ? 'true' : 'false'" class="flex items-center gap-1 px-3 py-1 rounded-full bg-gradient-to-r from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 text-blue-700 dark:text-blue-200 font-semibold shadow hover:scale-105 hover:bg-blue-200 dark:hover:bg-blue-700 transition focus:outline-none" id="user-menu" aria-haspopup="true" tabindex="0">
                        <!-- Heroicon: User -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7 7 0 1117.805 5.12M12 12a5 5 0 100-10 5 5 0 000 10z" />
                        </svg>
                        <span>Compte</span>
                        @if(auth()->check() && auth()->user()->hasRole('admin'))
                            <span class="bg-red-600 text-white text-xs px-2 py-0.5 rounded ml-2">Admin</span>
                        @endif
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-cloak @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg z-50" role="menu" aria-orientation="vertical" aria-labelledby="user-menu" x-transition>
                        <a href="/compte" class="flex items-center gap-2 px-4 py-2 text-black hover:bg-blue-100 focus:bg-blue-100 focus:outline-none" role="menuitem" tabindex="0" @click="open = false">
                            <!-- User Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7 7 0 1117.805 5.12M12 12a5 5 0 100-10 5 5 0 000 10z" />
                            </svg>
                            Mon Compte
                        </a>
                        <form method="POST" action="{{ route('logout') }}" @submit="open = false">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-black hover:bg-blue-100 focus:bg-blue-100 focus:outline-none" role="menuitem" tabindex="0">
                                <!-- Logout Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                                </svg>
                                Se Déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="/login" class="flex items-center gap-1 px-3 py-1 rounded-full bg-gradient-to-r from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 text-blue-700 dark:text-blue-200 font-semibold shadow hover:scale-105 hover:bg-blue-200 dark:hover:bg-blue-700 transition">
                    <!-- Heroicon: User -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7 7 0 1117.805 5.12M12 12a5 5 0 100-10 5 5 0 000 10z" />
                    </svg>
                    <span>Compte</span>
                </a>
            @endauth
            <a href="/home" class="flex items-center gap-1 px-3 py-1 rounded-full bg-gradient-to-r from-pink-100 to-pink-200 dark:from-pink-900 dark:to-pink-800 text-pink-700 dark:text-pink-200 font-semibold shadow hover:scale-105 hover:bg-pink-200 dark:hover:bg-pink-700 transition">
                <!-- Heroicon: Shopping Cart -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 007 17h10a1 1 0 001-1v-1M16 17a2 2 0 11-4 0" />
                </svg>
                <span>Panier</span>
            </a>
        </div>
    </div>
</div>

<!-- Second Navbar -->
<div class="bg-white/95 border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-2 flex items-center justify-between">
        <!-- Center: Nav Links -->
        <div class="flex-1 flex justify-center">
            <nav class="flex space-x-8">
                @php $user = Auth::user(); $route = request()->route() ? request()->route()->getName() : null; @endphp
                <a href="{{ route('home') }}" class="text-black font-semibold hover:text-blue-600 hover:underline transition tracking-wide {{ request()->is('home') ? 'underline text-blue-600' : '' }}">Accueil</a>
                <a href="{{ route('products.index') }}" class="text-black font-semibold hover:text-blue-600 hover:underline transition tracking-wide {{ request()->is('products*') ? 'underline text-blue-600' : '' }}">Produits</a>
                @if($user && $user->hasRole('admin'))
                    <a href="{{ route('admin.dashboard') }}" class="text-black font-semibold hover:text-blue-600 hover:underline transition tracking-wide {{ request()->routeIs('admin.dashboard') ? 'underline text-blue-600' : '' }}">Dashboard</a>
                @elseif($user && $user->hasRole('stock'))
                    <a href="{{ route('stock.dashboard') }}" class="text-black font-semibold hover:text-blue-600 hover:underline transition tracking-wide {{ request()->routeIs('stock.dashboard') ? 'underline text-blue-600' : '' }}">Dashboard</a>
                @elseif($user)
                    <a href="{{ route('user.dashboard') }}" class="text-black font-semibold hover:text-blue-600 hover:underline transition tracking-wide {{ request()->routeIs('user.dashboard') ? 'underline text-blue-600' : '' }}">Dashboard</a>
                @endif
                <a href="{{ route('boutique') }}" class="text-black font-semibold hover:text-pink-600 hover:underline transition tracking-wide {{ request()->is('boutique') ? 'underline text-pink-600' : '' }}">Boutique</a>
            </nav>
        </div>
        <!-- Right: Language & Dark Mode -->
        <div class="flex items-center space-x-3">
            <!-- Language Switcher -->
            <button title="Changer la langue" class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 font-medium transition">
                <!-- Heroicon: Globe -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3C7.03 3 3 7.03 3 12s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 0c2.21 0 4 4.03 4 9s-1.79 9-4 9-4-4.03-4-9 1.79-9 4-9z" />
                </svg>
                <span>Fr/En</span>
            </button>
            <!-- Dark Mode Toggle -->
            <button @click="$store.darkMode.toggle()" class="text-gray-700 hover:text-blue-600 transition">
                <svg x-show="!$store.darkMode.on" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.485-8.485l-.707.707M4.222 4.222l.707.707M3 12h1m16 0h1M4.222 19.778l.707-.707M19.778 4.222l-.707.707" />
                </svg>
                <svg x-show="$store.darkMode.on" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 0112.21 3a7 7 0 108.79 9.79z" />
                </svg>
            </button>
        </div>
    </div>
</div>

{{-- Alpine.js should be loaded in your layout. --}}
