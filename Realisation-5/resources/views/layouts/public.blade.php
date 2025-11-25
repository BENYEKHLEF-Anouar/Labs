<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Blog Group-1')</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- HEADER / NAVIGATION -->
    <nav class="bg-white shadow-md fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">
                    Blog Group-1
                </a>

                <!-- Desktop Links -->
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-600 font-medium border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition' }}">Accueil</a>
                    <a href="{{ route('favorites') }}" class="{{ request()->routeIs('favorites') ? 'text-blue-600 font-medium border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition' }}">Favoris</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition">Login</a>
                </div>

                <!-- Hamburger button for mobile -->
                <div class="md:hidden flex items-center">
                    <button id="menu-btn" class="text-gray-800 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md px-4 py-4 space-y-2">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'block text-blue-600 font-medium border-b-2 border-blue-600 pb-1' : 'block text-gray-600 hover:text-blue-600 transition' }}">Accueil</a>
                <a href="{{ route('favorites') }}" class="{{ request()->routeIs('favorites') ? 'block text-blue-600 font-medium border-b-2 border-blue-600 pb-1' : 'block text-gray-600 hover:text-blue-600 transition' }}">Favoris</a>
                <a href="#" class="block text-gray-600 hover:text-blue-600 transition">Login</a>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- FOOTER -->
    @yield('footer')

    @stack('scripts')
</body>
</html>
